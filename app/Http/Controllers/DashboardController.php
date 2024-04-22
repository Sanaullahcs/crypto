<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CouponCode;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = CouponCode::all(); // You can use different methods to retrieve coupons based on your requirements

        return response()->json($coupons);
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
        $request->validate([
            'code' => 'required|unique:coupon_codes',
            'discount' => 'required|numeric',
        ]);
        $isCouponShowHomePage = $request->input('is_coupon_show_home_page', 1);

        if ($request->input('is_coupon_show_home_page')) {
            CouponCode::where('is_coupon_show_home_page', 1)->update(['is_coupon_show_home_page' => 0]);
        }

        $coupon =  CouponCode::create([
            'user_id' => $request->selectedUserEmail,
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'is_active' => $request->input('is_active'),
            'one_time' => $request->input('one_time'),
            'expiry_date' => $request->input('expiry_date'),
            'is_coupon_show_home_page' => $isCouponShowHomePage,

        ]);



        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); // Replace with your actual Stripe secret key

        // Use the newly created coupon data to create a coupon in Stripe
        $stripeCoupon = \Stripe\Coupon::create([
            'percent_off' => $coupon->discount, // Use discount from your database
            'duration' => 'once', // Duration of the coupon ('once', 'repeating', or 'forever')
            'name' => $coupon->code, // Use code from your database as the name of the coupon
            // Optionally, you can add more parameters like 'duration_in_months', 'max_redemptions', etc.
        ]);
        // Update the coupon in your database with the Stripe coupon ID
        $coupon->update(['stripe_coupon_id' => $stripeCoupon->id]);

        return response()->json([
            'message' => 'success',
            'coupon' => $coupon,
            'stripe_coupon' => $stripeCoupon,
        ]);
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
    public function update(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'id' => 'required',
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'is_active' => 'required|boolean',
        ]);

        // Find the coupon by ID
        $coupon = CouponCode::find($request->input('id'));

        if (!$coupon) {
            // Handle if the coupon is not found
            return response()->json(['error' => 'Coupon not found'], 404);
        }
        // Update the coupon details
        $coupon->user_id = $request->input('user_id');
        $coupon->code = $request->input('code');
        $coupon->discount = $request->input('discount');
        $coupon->is_active = $request->input('is_active');
        $coupon->one_time = $request->input('one_time');
        $coupon->expiry_date = $request->input('expiry_date');
        $coupon->is_coupon_show_home_page = $request->input('is_coupon_show_home_page');
        // Save the changes
        $coupon->save();

        // Update the corresponding coupon in Stripe
        if ($coupon->stripe_coupon_id) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); // Replace with your actual Stripe secret key

            // Retrieve the existing Stripe coupon
            $existingStripeCoupon = \Stripe\Coupon::retrieve($coupon->stripe_coupon_id);
            // Create a new coupon in Stripe with updated details
            $updatedStripeCoupon = \Stripe\Coupon::create([
                'percent_off' => $coupon->discount, // Discount percentage
                'duration' => 'once', // Duration of the coupon ('once', 'repeating', or 'forever')
                'name' => $coupon->code, // Coupon name
                // Other fields you may want to set for the new coupon
            ]);
            // Delete the existing Stripe coupon
            $existingStripeCoupon->delete();
            // Update the local coupon record with the new Stripe coupon ID
            $coupon->update(['stripe_coupon_id' => $updatedStripeCoupon->id]);
        }

        // Return a response indicating success
        return response()->json(['message' => 'Coupon updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {

        try {
            // Find the coupon by its ID
            $coupon = CouponCode::find($id);

            if (!$coupon) {
                // Handle the case where the coupon does not exist
                return response()->json(['message' => 'Coupon not found'], 404);
            }

            // Delete the coupon
            $coupon->delete();

            return response()->json(['message' => 'Coupon deleted successfully']);
        } catch (\Exception $e) {
            // Handle any errors that may occur during deletion
            return response()->json(['message' => 'Coupon deletion failed'], 500);
        }
    }


    public function discountshowhomepage()
    {
        try {
            $discountshow = CouponCode::where('is_coupon_show_home_page', 1)->latest()->first();

            if (!$discountshow) {
                return response()->json(['error' => 'Coupon not found'], 404);
            }

            return response()->json([
                'name' => $discountshow->code,
                'discount' => $discountshow->discount,
                'expiry_date' => $discountshow->expiry_date,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching discount show: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve discount show'], 500);
        }
    }
}