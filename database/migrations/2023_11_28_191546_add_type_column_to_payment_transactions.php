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
            $table->string('type')->nullable(); // Change 'string' to your desired column type
        });
    }

    public function down()
    {
        Schema::table('payment_transaction', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
