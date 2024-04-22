<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coupon_codes', function (Blueprint $table) {
            $table->dateTime('expiry_date')->nullable(); // Add this line for the new column
            $table->boolean('is_coupon_show_home_page')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupon_codes', function (Blueprint $table) {
            $table->dropColumn('expiry_date'); // Add this line for the new column
            $table->dropColumn('is_coupon_show_home_page');
        });
    }
};
