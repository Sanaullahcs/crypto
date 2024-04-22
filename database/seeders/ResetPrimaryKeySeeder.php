<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetPrimaryKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $newStartValue = 10001;
        // Get all subscriptions
        $subscriptions = Subscription::all();
        // Update the IDs
        foreach ($subscriptions as $index => $subscription) {
            $subscription->id = $newStartValue + $index;
            $subscription->save();
        }
        // Optionally, update the auto-increment value to avoid conflicts
        $tableName = (new Subscription())->getTable();
        DB::statement("ALTER TABLE {$tableName} AUTO_INCREMENT = " . ($newStartValue + count($subscriptions)));
    }

}
