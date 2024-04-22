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
        Schema::create('payment_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('payment_intent_id')->nullable();
            $table->string('object')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amount_capturable')->nullable();
            $table->json('amount_details')->nullable();
            $table->integer('amount_received')->nullable();
            $table->string('capture_method')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('confirmation_method')->nullable();
            $table->timestamp('created')->nullable();
            $table->string('currency')->nullable();
            $table->string('latest_charge')->nullable();
            $table->boolean('livemode')->nullable();
            $table->string('payment_method')->nullable();
            $table->json('payment_method_configuration_details')->nullable();
            $table->json('payment_method_options')->nullable();
            $table->json('payment_method_types')->nullable();
            $table->string('status')->nullable();
            // Additional timestamps if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transaction');
    }
};
