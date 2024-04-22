<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\PaymentTransaction;
use App\Models\Subscription;
use App\Models\Settings;
use App\Models\CouponCode;
use App\Models\SubscriptionPlan;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Stripe\Stripe as StripeGateway;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\TransactionSearch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\SendReciptOnEmail;
use Stripe\Exception\ApiErrorException;
use Stripe\Subscription as StripeSubscription;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;


class StripeController extends Controller
{
    public function initiatePayment(Request $request)
    {

        StripeGateway::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Multiply as & when required
                'currency' => $request->currency,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            // Save the $paymentIntent->id to identify this payment later
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return [
            'token' => (string) Str::uuid(),
            'client_secret' => $paymentIntent->client_secret
        ];
    }


    public function completePayment(Request $request)
    {


        $user = $request->input('user');
        $coupon_code = $request->input('coupon');
        $plan_id = $request->input('plan_id');
        $user = $request->input('user');
        $paypalDetails =  $request->input('details');
        $data =  $request->input('data');
        // dd($data['payerID']);
        //  dd(env('STRIPE_SECRET'));
        $subscriptionplan = SubscriptionPlan::find($plan_id);


        $settingcouponcode = Settings::where('key', 'coupon')->value('value');
        $settingcouponcoupon_price = Settings::where('key', 'coupon_price')->value('value');
        if ($settingcouponcode) {
            $registerdiscount =  $settingcouponcode;
        } elseif ($settingcouponcoupon_price == 0) {
            $registerdiscount = 0;
        }


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $subscriptioncouponcode = CouponCode::where('code', $coupon_code)->first();

        if ($subscriptioncouponcode) {
            $combinedDiscount = $subscriptioncouponcode->stripe_coupon_id;
        } else {
            $combinedDiscount = '';
        }


        $stripe = new StripeClient(env('STRIPE_SECRET'));

        if ($request->type == 'paypal') {
   //dd($request->all());
            // Retrieve PayPal configuration from services.php config file
            $paypalConfig = config('services.paypal');

            // Initialize PayPal API Context
            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    $paypalConfig['client_id'],
                    $paypalConfig['secret']
                )
            );

            $apiContext->setConfig([
                'mode' => $paypalConfig['sandbox'] // 'sandbox' or 'live'
            ]);
            // dd( $apiContext );
            // Replace this with your actual product ID from PayPal
            $productId = $subscriptionplan['paypal_product_id'];

            // Replace with your subscription plan details
            $subscription = new Subscription();
            $subscription->setName('Monthly Subscription')
                ->setDescription('Monthly subscription plan')
                ->setQuantity(1)
                ->setStartDate(date('Y-m-d\TH:i:s\Z', strtotime('+1 day'))) // Start date for the subscription
                ->setPlanId($productId); // Use the product ID obtained from PayPal

            try {
                $createdSubscription = $subscription->create($this->apiContext);

                // Handle successful subscription creation
                if ($createdSubscription) {
                    // Subscription created successfully
                    // You can retrieve subscription details like $createdSubscription->id, etc.
                    return response()->json(['success' => true, 'subscription_id' => $createdSubscription->id]);
                }
            } catch (\Exception $e) {
                // Handle subscription creation failure
                return response()->json(['error' => $e->getMessage()], 500);
            }


            $payment = new PaymentTransaction();
            $payment->user_id = $user['id'];

            $payment->payment_intent_id = $paypalDetails['id'];
            $payment->object = $paypalDetails['intent'];
            $payment->amount = $paypalDetails['purchase_units'][0]['amount']['value'];
            $payment->amount_capturable = $paypalDetails['purchase_units'][0]['amount']['value'];
            $payment->amount_details = $paypalDetails['purchase_units'][0]['amount']['value'];
            $payment->amount_received = $paypalDetails['purchase_units'][0]['amount']['value'];
            $payment->status = $paypalDetails['status'];
            $payment->type = 'paypal';
            $payment->couponcode = $coupon_code;

            // ... add other fields accordingly
            // Save the payment intent data to the database
            $payment->save();
            $subscription = new Subscription();
            $subscription->user_id = $user['id'];
            $subscription->plan_id = $plan_id;
            $subscription->name = $subscriptionplan->name;
            $subscription->paypal_product_id  = $data['payerID'];
            $subscription->stripe_status  = $paypalDetails['status'];
            $subscription->stripe_price  = $paypalDetails['purchase_units'][0]['amount']['value'];
            $subscription->paypal_price_id = $data['paymentID'];
            $subscription->quantity = 1;
            $subscription->trial_ends_at = now();
            $subscription->ends_at = now();
            $subscription->type = 'paypal';
            $subscription->save();

            return response()->json([
                'message' => 'success',
                'IntentID' => $subscription,

            ], 200);
        } else {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            // Create a new customer
            $customer = $stripe->customers->create([
                'email' =>  $user['email'], // Replace with the customer's email
                // You can add more parameters like name, metadata, etc., if needed
            ]);
            $customerId = $customer->id;
            if ($combinedDiscount  != 0) {

                // Get the price ID from the request
                $priceId = $subscriptionplan['price_id']; // Assuming 'priceId' comes from the request
                $subscription = $stripe->subscriptions->create([
                    'customer' => $customerId,
                    'items' => [
                        ['price' => $priceId],
                    ],
                    'coupon' => $combinedDiscount, // Use the coupon code here
                    'payment_behavior' => 'default_incomplete',
                    'payment_settings' => ['save_default_payment_method' => 'on_subscription'],
                    'expand' => ['latest_invoice.payment_intent'],
                ]);
            } else {
                // Get the price ID from the request
                $priceId = $subscriptionplan['price_id']; // Assuming 'priceId' comes from the request

                $subscription = $stripe->subscriptions->create([
                    'customer' => $customerId,
                    'items' => [
                        ['price' => $priceId],
                    ],

                    'payment_behavior' => 'default_incomplete',
                    'payment_settings' => ['save_default_payment_method' => 'on_subscription'],
                    'expand' => ['latest_invoice.payment_intent'],
                ]);
            }

            $subscriptionId = $subscription['id'];
            $subscriptionstatus = $subscription->status;

            $currentPeriodStart = Carbon::createFromTimestamp($subscription['current_period_start']);
            $currentPeriodEnd = Carbon::createFromTimestamp($subscription['current_period_end']);

            $newEndDatetrial = $currentPeriodStart->addDays(7)->toDateTimeString();

            $userPaymentid = Subscription::where('user_id',$user['id'])->first();

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::retrieve($userPaymentid->payment_id);
            $carddetails = $stripe->charges->retrieve($paymentIntent->latest_charge, []);

            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $paymentIntents = $stripe->paymentIntents->all(['limit' => 100]); // Fetch up to 100 payment intents

            if (!empty($paymentIntents->data)) {
                // Sort payment intents by created date/time
                usort($paymentIntents->data, function ($a, $b) {
                    return $b->created - $a->created;
                });
                $lastPaymentIntent = $paymentIntents->data[0];


                $invoice_number = $stripe->invoices->retrieve($lastPaymentIntent['invoice'], []);


                $productname = $stripe->products->retrieve($subscriptionplan->product_id, []);
                // dd($productname->name );
                $lastPaymentIntentId = $lastPaymentIntent->id;

                $subscriptionData = [
                    'user_id' => $user['id'],
                    'plan_id' => $plan_id,
                    'subscription_id' => $subscriptionId,
                    'name' => $subscriptionplan->name,
                    'stripe_id' => $lastPaymentIntent['id'],
                    'stripe_status' => $subscriptionstatus,
                    'last4' => $carddetails->payment_method_details['card']['last4'],
                    'card_brand' =>  $carddetails->payment_method_details['card']['brand'],
                    'stripe_price' => $lastPaymentIntent['amount'],
                    'quantity' => 1,
                    'trial_ends_at' => $newEndDatetrial,
                    'ends_at' => $currentPeriodEnd,
                    'couponcode' => $combinedDiscount,
                    'registerdiscount' => $registerdiscount,
                    'invoice_id' => $lastPaymentIntent['invoice'],
                    'product_name' => $productname->name,
                    'invoice_number' => $invoice_number['number'],
                    'type' => 'stripe'

                ];
                $subscription = Subscription::updateOrInsert(['user_id' => $user['id']], $subscriptionData);
                // $subscription = new Subscription();
                // $subscription->user_id = $user['id'];
                // $subscription->plan_id = $plan_id;
                // $subscription->subscription_id = $subscriptionId;
                // $subscription->name = $subscriptionplan->name;
                // $subscription->stripe_id  = $lastPaymentIntent['id'];
                // $subscription->stripe_status  = $subscriptionstatus;
                // $subscription->stripe_price = $lastPaymentIntent['amount'];
                // $subscription->quantity = 1;
                // $subscription->trial_ends_at =   $newEndDatetrial;
                // $subscription->ends_at = $currentPeriodEnd;
                // $subscription->couponcode = $combinedDiscount;
                // $subscription->registerdiscount = $registerdiscount;
                // $subscription->invoice_id = $lastPaymentIntent['invoice'];
                // $subscription->product_name = $productname->name;
                // $subscription->invoice_number = $invoice_number['number'];



                // $subscription->type = 'stripe';
                // $subscription->save();

                $userDetails = $request->input('user');

                // Send the email using SendReciptOnEmail Mailable
                Mail::to($userDetails['email'])->send(new SendReciptOnEmail($subscription->first(), $userDetails));


                return response()->json([
                    'message' => 'success',
                    'IntentID' => $lastPaymentIntentId,


                ], 200);
            } else {
                return response()->json([
                    'message' => 'No payment intents found.',

                ], 401);
            }
        }
        // Complete the payment
    }

    public function failPayment(Request $request)
    {
        // Log the failed payment if you wish
    }

    public function getIntent(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // // Create a new customer
        // $customer = $stripe->customers->create([
        //     'email' => $user->email, // Replace with the customer's email
        //     // You can add more parameters like name, metadata, etc., if needed
        // ]);

        $amountInDollars = $request->query('data');

        // Convert amount to cents
        $formattedPrice = (int)($amountInDollars * 100);

        // Check if the amount is zero
        if ($formattedPrice === 0) {
            // Handle the case when the amount is zero
            // You may want to return a specific message or handle it differently
            $payment = User::find($id)->pay((int)(1 * 100));
            return $payment->client_secret;
        }
        // Perform the payment operation using the provided user ID
        $payment = User::find($id)->pay($formattedPrice);
        $subscription = Subscription::create([
            'user_id' => $user['id'],
            'payment_id' => $payment->id,
            'name' => 'null',
            'stripe_status' => 'null',
        ]);
        return $payment->client_secret;
    }

    public function UpdateSubscriptionStatus(Request $request)
    {

        $events = [$request->all()];

        foreach ($events as $event) {
            Log::info($event['type']);
            // Check if the event type is 'invoice.paid'
            if ($event['type'] === 'invoice.paid') {
                // Extract relevant data from the event
                $invoiceData = $event['data']['object'];
                $subscriptionId = $invoiceData['subscription'];

                // Retrieve the subscription from your database
                $subscription = Subscription::where('subscription_id', $subscriptionId)->first();

                if ($subscription) {
                    // Extract more relevant data from the invoice
                    $invoiceId = $invoiceData['id'];
                    $paymentIntentId = $invoiceData['payment_intent'];
                    $amountPaid = $invoiceData['amount_paid'];

                    // Extract coupon details if available
                    $coupon = $invoiceData['discounts'][0]['coupon'] ?? null;
                    $couponName = null;
                    $couponStatus = null;

                    if ($coupon) {
                        $couponName = $coupon['name'];
                        $couponStatus = $coupon['valid'] ? 'Valid' : 'Invalid';
                    }

                    // Create a new PaymentTransaction record
                    $payment = new PaymentTransaction();
                    $payment->user_id = $subscription->user_id;
                    $payment->subscription_id = $subscription->id; // Assuming you have an 'id' field in your Subscription model
                    $payment->invoice_id = $invoiceId;
                    $payment->payment_intent_id = $paymentIntentId;
                    $payment->amount_paid = $amountPaid;
                    $payment->coupon_name = $couponName; // Save coupon name
                    $payment->coupon_status = $couponStatus; // Save coupon status
                    // Add other relevant fields as needed

                    // Save the PaymentTransaction record
                    $payment->save();

                    $this->info('Payment transaction saved.');
                } else {
                    $this->error('Subscription not found.');
                }
            }
        }
    }

    public function cancelSubscription(Request $request)
    {

        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $subscriptionId =  Subscription::where('plan_id', $request->input('subscription_id'))->first();

            $subscription = StripeSubscription::retrieve($subscriptionId->subscription_id);


            $canceledSubscription = $subscription->cancel();

            return response()->json([
                'success' => true,
                'canceled_subscription' => $canceledSubscription,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function GetLastSubscription()
    {
        $latestSubscription = Subscription::latest()->first();
        // $carddetails = $stripe->charges->retrieve('ch_3OduRWHgAJ2a2cU61bw3n12U', []);
        if ($latestSubscription) {
            return response()->json($latestSubscription, 200);
        }

        return response()->json(['message' => 'No subscriptions found'], 404);
    }
}
