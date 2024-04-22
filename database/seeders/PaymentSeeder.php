<?php

namespace Database\Seeders;
use App\Models\PaymentTransaction; // Replace 'App\Models\Payment' with your actual model namespace

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userIds = [1, 2, 3]; // User IDs to assign to payments
        // Generate 5 dummy records
        for ($i = 0; $i < 5; $i++) {
            PaymentTransaction::create([
                'user_id' => $userIds[$i % count($userIds)], // Assign user_id cyclically
                'payment_intent_id' => 'payment_' . ($i + 1),
                'object' => 'object_' . ($i + 1),
                'amount' => rand(100, 1000), // Replace with your desired range or logic
                'amount_capturable' => rand(50, 500),
                'amount_details' => 'details_' . ($i + 1),
                'amount_received' => rand(50, 100),
                // Add dummy data for other fields similarly
                'status' => 'pending', // Example status
                'type' => 'card', // Example type
                'couponcode' => 'coupon_' . ($i + 1),
                'register_couponcode' => 'register_coupon_' . ($i + 1),
                // Add other fields as necessary
            ]);
        }
    }
}
