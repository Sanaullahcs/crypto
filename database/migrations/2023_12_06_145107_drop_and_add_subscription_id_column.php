<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Drop the existing column
            $table->dropColumn('subscription_id');
        });
        
        Schema::table('subscriptions', function (Blueprint $table) {
            // Add the column with the new type
            $table->string('subscription_id', 255)->nullable()->after('plan_id'); // Modify the position as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Recreate the previous column type (if needed)
            $table->bigInteger('subscription_id')->after('plan_id'); // Position must match original placement
        });
    }
};
