<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationCode;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Str;
use App\Models\RegisterInvitation;
use App\Models\Contact;

use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{


    public function checkInvite($slug)
    {
        $invite = RegisterInvitation::where('unique_id', $slug)
            ->whereNull('register_date_time')
            ->first();
        if ($invite) {
            // Invite ID exists in the database
            return response()->json(['exists' => true]);
        } else {
            // Invite ID doesn't exist in the database
            return response()->json(['exists' => false]);
        }
    }

    public function register(Request $request)
    {


        $validatedData = $request->validate([
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'agreed' => 'required',
        ], [
            'agreed.required' => 'Please check this box if you want to proceed.',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $verificationCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
        $user = User::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => ($validatedData['lastName']) ?? '',
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'verification_code' => $verificationCode,
        ]);
        $inviteSlug = $request->inviteSlug;
        // generate 6 digit alpha numberic varification code

        $accessToken = $user->createToken('authToken');

        // send verification code email to user
        Mail::to($validatedData['email'])->send(new VerificationCode($verificationCode, 'register'));

        if ($inviteSlug !== null) {

            // Find the RegisterInvitation record based on the inviteSlug
            $invitation = RegisterInvitation::where('unique_id', $inviteSlug)->first();

            // If the invitation is found, update the register_date_time
            if ($invitation) {
                $invitation->register_date_time = now(); // Update the register_date_time field
                $invitation->save(); // Save the changes to the database
            }
            $user->register_from_invite = 1;
            $user->save();

            $planIds = SubscriptionPlan::pluck('id')->toArray(); // Get all plan IDs

            $randomPlanId = $planIds[array_rand($planIds)]; // Pick a random plan ID

            $subscriptionplan = SubscriptionPlan::find($randomPlanId);

            $subscription = new Subscription();
            $subscription->user_id = $user->id;
            $subscription->plan_id = $subscriptionplan->id;
            $subscription->subscription_id =  Str::random(12);
            $subscription->name = $subscriptionplan->name;
            $subscription->stripe_id  = Str::random(12);
            $subscription->stripe_status  = 'incomplete';
            $subscription->stripe_price = 0;
            $subscription->quantity = 1;
            $subscription->trial_ends_at =   now();
            $subscription->ends_at = now();
            $subscription->registerdiscount = Str::random(6);


            $subscription->type = 'without Payment';
            $subscription->save();
        }



        return response(['user' => $user, 'access_token' => $accessToken, 'status' => 'success']);
    }

    public function Adminregister(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $verificationCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
        $user = User::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => ($validatedData['lastName']) ?? '',
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'email_verified_at' => now(),
            'is_admin' => 1,
            'verification_code' => $verificationCode,
        ]);

        // generate 6 digit alpha numberic varification code

        $accessToken = $user->createToken('authToken');

        // send verification code email to user
        Mail::to($validatedData['email'])->send(new VerificationCode($verificationCode, 'register'));

        return response(['user' => $user, 'access_token' => $accessToken, 'status' => 'success']);
    }

    public function UpdateAdminregister(Request $request, $id = null)
    {
        // Validation rules
        $validationRules = [
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
        ];

        // Check if password is provided
        if ($request->filled('password')) {
            $validationRules['password'] = 'required|confirmed';
        }

        // Apply validation rules
        $validatedData = $request->validate($validationRules);

        // Hash password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        // Retrieve the user by ID
        $user = User::find($id);

        if ($user) {
            // Update existing user with provided data
            $user->update([
                'first_name' => $validatedData['firstName'],
                'last_name' => $validatedData['lastName'],
                'is_admin' => 1,
                // Update password only if provided
                'password' => $request->filled('password') ? $validatedData['password'] : $user->password,
            ]);

            return response(['user' => $user, 'status' => 'success']);
        }

        return response(['message' => 'User not found'], 404);
    }



    public function verify($code, $id)
    {
        $user = User::find($id);

        $subscriptionTrialId = Subscription::where('user_id', $user->id)->where('stripe_status', 'incomplete')->first();

        $currentDate = Carbon::now();
        // Calculate the difference in days
        if ($subscriptionTrialId != null) {
            $trialdaysDifference = $subscriptionTrialId ? $currentDate->diffInDays($subscriptionTrialId->trial_ends_at) : '';
        } else {
            $trialdaysDifference = '';
        }

        if ($user->verification_code == $code) {
            $user->email_verified_at = now();
            // $user->verification_code = null;
            $user->save();
            return response(['message' => 'Email verified successfully', 'trial_days_difference' => $trialdaysDifference, 'status' => 'success'], 200);
        } else {
            return response(['message' => 'Invalid code, please verify them and retry.', 'status' => 'error'], 400);
        }
    }
    public function FreeTrial($id)
    {
        $user = User::find($id);
        $subscriptionTrialId = Subscription::where('user_id', $user->id)->where('stripe_status', 'incomplete')->first();
        $currentDate = Carbon::now();
        // Calculate the difference in days
        if ($subscriptionTrialId != null) {
            $trialdaysDifference = $subscriptionTrialId ? $currentDate->diffInDays($subscriptionTrialId->trial_ends_at) : '';
        } else {
            $trialdaysDifference = '';
        }
        return response(['trial_days_difference' => $trialdaysDifference, 'status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        try {
            $verificationCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
            $user = User::where('email', $loginData['email'])->first();
            // Assuming $user->expire_date contains the expiration date from your user table
            // $subscriptionTrialId = Subscription::where('user_id',$user->id)->where('stripe_status','incomplete')->first();
            // $currentDate = Carbon::now();
            // // Calculate the difference in days
            // $trialdaysDifference = $subscriptionTrialId ? $currentDate->diffInDays($subscriptionTrialId->trial_ends_at) : '';

            if (!$user) {
                return response(['message' => 'Invalid credentials', 'status' => 'error'], 400);
            }
            $user->verification_code = $verificationCode;

            $user->save();

            // send verification code email to user
            // Mail::to($loginData['email'])->send(new VerificationCode($verificationCode, 'login'));

            if (!auth()->attempt($loginData)) {
                return response(['message' => 'Invalid credentials', 'status' => 'error'], 400);
            }

            $accessToken = auth()->user()->createToken('authToken');
            $token = $accessToken->plainTextToken;
        } catch (\Throwable $th) {
            return response(['message' => 'Something went wrong', 'status' => 'error'], 500);
        }

        return response(['user' => auth()->user(), 'token' => $token, 'status' => 'success']);
    }

    public function user(Request $request)
    {
        return response(['user' => auth()->user(), 'status' => 'success']);
    }
    public function AllUser(Request $request)
    {
        $users = User::get();
        $userCount = User::count();
        $adminCount = User::where('is_admin', 1)->count();

        $activeSubscriptions = Subscription::where('stripe_status', 'complete')->count();
        $totalSubscriptions = Subscription::whereNotNull('plan_id')
            ->whereNotNull('last4')
            ->count();

        $totalRevenue = PaymentTransaction::sum('amount'); // Assuming 'amount' is the field representing the transaction amount
        $totalanswered = Contact::where('status', 1)->count();
        $totaldeclined = Contact::where('status', 2)->count();
        $totalnotanswerd = Contact::where('status', 0)->count();
        // Get the current date
        $currentDate = Carbon::now();
        // Total users expiring in less than or equal to 30 days
        $totalExpiring30Days = Subscription::where('ends_at', '<=', $currentDate->copy()->addDays(30))->count();
        // Total users expiring in less than or equal to 60 days
        $totalExpiring60Days = Subscription::where('ends_at', '<=', $currentDate->copy()->addDays(60))->count();
        // Total users expiring in less than or equal to 90 days
        $totalExpiring90Days = Subscription::where('ends_at', '<=', $currentDate->copy()->addDays(90))->count();
        // Total users expiring in greater than 90 days
        $totalExpiringGreaterThan90Days = Subscription::where('ends_at', '>', $currentDate->copy()->addDays(90))->count();

        $total_subscriptions_expired = Subscription::where('ends_at', '<', $currentDate->startOfDay())->count();


        // $monthlyRevenueData = PaymentTransaction::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as revenue'))
        // ->whereYear('created_at', Carbon::now()->year)
        // ->groupBy(DB::raw('MONTH(created_at)'))
        // ->get();

        $stats = [
            'users' =>  $users,
            'total_admin_count' => $adminCount,
            'total_users' => $userCount,
            'active_subscriptions' => $activeSubscriptions,
            'total_subscriptions' => $totalSubscriptions,
            'total_revenue' => $totalRevenue,
            'total_answered' => $totalanswered,
            'total_declined' => $totaldeclined,
            'total_not_answerd' => $totalnotanswerd,
            'total_expiring_30_days' => $totalExpiring30Days,
            'total_expiring_60_days' => $totalExpiring60Days,
            'total_expiring_90_days' => $totalExpiring90Days,
            'total_expiring_greater_than_90_days' => $totalExpiringGreaterThan90Days,
            'total_subscriptions_exipred' => $total_subscriptions_expired
        ];

        // dd($stats);
        return response()->json(['stats' => $stats, 'status' => 'success']);
    }



    public function forgotPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required|exists:users',
        ], [
            'email.exists' => 'Email does not exist',
        ]);

        $verificationCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
        $user = User::where('email', $validatedData['email'])->first();
        $user->verification_code = $verificationCode;
        $user->save();

        Mail::to($validatedData['email'])->send(new VerificationCode($verificationCode, 'forgot-password'));

        return response(['message' => 'Verification code sent to your email', 'status' => 'success', 'user' => $user]);
    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', $validatedData['id'])->first();
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return response(['message' => 'Password reset successfully', 'status' => 'success']);
    }


    public function delete($id)
    {
        try {
            // Find the coupon by its ID
            $user = User::find($id);
            if (!$user) {
                // Handle the case where the coupon does not exist
                return response()->json(['message' => 'User not found'], 404);
            }
            // Delete the coupon
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            // Handle any errors that may occur during deletion
            return response()->json(['message' => 'User deletion failed'], 500);
        }
    }
}