<?php

namespace App\Http\Controllers\Api;
use App\Models\Settings;
use App\Models\RegisterInvitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvitation;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function saveCoupon(Request $request)
    {

    // Validate the request data as needed
    $request->validate([
        'discount' => 'required',
    ]);

    $formattedDiscount = number_format($request->discount, 2, '.', '');

    // Save the coupon data in the settings table
    $couponSetting = Settings::updateOrCreate(
        ['key' => 'coupon_price'],
        ['value' => $formattedDiscount]
    );
    // Update or create the coupon in Stripe
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); // Replace with your actual Stripe secret key
    $existingStripeCoupon = null;
    $couponValue = $couponSetting->value;
    $couponSetting = Settings::where('key','coupon')->first();

    if ($couponSetting->value) {
        try {
            // Retrieve existing coupon from Stripe
            $existingStripeCoupon = \Stripe\Coupon::retrieve($couponSetting->value);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle the exception if the coupon is not found
        }
    }

    if( $formattedDiscount == 0){
        return response()->json([
            'message' => 'success',
            'coupon' => $couponSetting,
        ]);
    }
    if ($existingStripeCoupon) {
        if ($existingStripeCoupon->percent_off != $formattedDiscount) {
            // If the discount has changed, delete the existing coupon and create a new one
            $existingStripeCoupon->delete();

            // Create a new coupon in Stripe
            $newStripeCoupon = \Stripe\Coupon::create([
                'percent_off' => $formattedDiscount,
                'duration' => 'once',
                'name' => 'Registration Coupon',
                // Other fields you may want to set for the new coupon
            ]);

            // Update the coupon value in your settings table with the new Stripe coupon ID
            $couponSetting->update(['value' => $newStripeCoupon->id]);

            return response()->json([
                'message' => 'success',
                'coupon' => $couponSetting,
                'stripe_coupon' => $newStripeCoupon,
            ]);
        }

        // No change in discount value
        return response()->json([
            'message' => 'success',
            'coupon' => $couponSetting,
            'stripe_coupon' => $existingStripeCoupon,
        ]);
    } else {
        // Create a new coupon in Stripe as the coupon doesn't exist
        $newStripeCoupon = \Stripe\Coupon::create([
            'percent_off' => $formattedDiscount,
            'duration' => 'once',
            'name' => 'Registration Coupon',
            // Other fields you may want to set for the new coupon
        ]);

        // Update the coupon value in your settings table with the new Stripe coupon ID
        $couponSetting = Settings::updateOrCreate(
            ['key' => 'coupon'],
            ['value' => $newStripeCoupon->id]
        );

        return response()->json([
            'message' => 'success',
            'coupon' => $couponSetting,
            'stripe_coupon' => $newStripeCoupon,
        ]);
    }

    return response()->json([
        'message' => 'success',
        'coupon' => $couponSetting,
        'stripe_coupon' => isset($updatedStripeCoupon) ? $updatedStripeCoupon : $newStripeCoupon,
    ]);
}


    public function CouponSettings(Request $request)
    {
        // Validate the request data as needed
        $coupon = Settings::where('key', 'coupon_price')->value('value');

        return response()->json(['coupon' => $coupon]);
    }

    public function updateSetting(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fromemail' => 'required|email', // You can use 'email' rule for email validation
        ]);

        // Save/update the 'from_email' setting in the database
        $fromemail = Settings::updateOrCreate(
            ['key' => 'from_email'],
            ['value' => $request->fromemail] // Ensure you're using the correct request field
        );

        return response(['fromemail' => $fromemail, 'status' => 'success']);
    }

    public function InviteUser(Request $request)
    {
        $user = $request->user_id;

        $user_id = json_decode($user,true);


        // Validate the request data
        $request->validate([
            'inviteEmail' => 'required|email',
            'user_id' => 'required', // Add any necessary validation rules for user_id
        ]);

        // Save/update the 'inviteEmail' and 'user_id' in the database
        $uniqueId = Str::random(30);
        // Save/update the 'inviteEmail' and 'user_id' in the database
        $registerInvitation = new RegisterInvitation();
        $registerInvitation->user_id = $user_id['id'];
        $registerInvitation->unique_id = $uniqueId;
        // $registerInvitation->register_date_time = now();
        // Other columns assignment if necessary
        $registerInvitation->save();

        Mail::to($request->inviteEmail)->send(new SendInvitation($registerInvitation));


        // Return a success response or any necessary data back to the frontend
        return response()->json([
            'status' => 'success',
            'message' => 'Invite sent successfully',
            // Include any other data you want to return
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
