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
        Schema::table('payment_transaction', function (Blueprint $table) {
            $table->string('couponcode')->nullable();
            $table->string('register_couponcode')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('payment_transaction', function (Blueprint $table) {
            $table->dropColumn('couponcode');
            $table->dropColumn('register_couponcode');
        });
    }
};
