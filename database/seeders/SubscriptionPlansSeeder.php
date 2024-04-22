<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
            // Insert dummy records into the subscription_plans table
            DB::table('subscription_plans')->insert([
                [
                    'name' => 'Basic',
                    'description' => 'Basic plan for starters',
                    'price' => 200,
                    'product_id' => 'prod_P06ZGYlZj5zrCj',
                    'price_id' => 'price_1OC6MPHgAJ2a2cU6ZiOFVACe',
                    'paypal_product_id' => 'PRD_003',
                    'paypal_price_id' => 'PRICE03',
                    'duration' => 'yearly',
                    'best_value' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Premium',
                    'description' => 'Advanced plan with more features',
                    'price' => 200,
                    'product_id' => 'prod_P06NyQAwpGqejO',
                    'price_id' => 'price_1OC6AMHgAJ2a2cU65fyWY1Ue',
                    'paypal_product_id' => 'PRD_1003',
                    'paypal_price_id' => 'PRICE103',
                    'duration' => 'monthly',
                    'best_value' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Standard',
                    'description' => 'Standard plan with medium features',
                    'price' => 100,
                    'product_id' => 'prod_P06NyQAwpGqejO',
                    'price_id' => 'price_1OC6AMHgAJ2a2cU65fyWY1Ue',
                    'paypal_product_id' => 'PRD_3003',
                    'paypal_price_id' => 'PRICE403',
                    'duration' => 'quarterly',
                    'best_value' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    
}
