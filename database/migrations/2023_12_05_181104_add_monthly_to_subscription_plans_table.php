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
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->dropColumn('duration');
        });

        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->enum('duration', ['yearly','monthly', 'quarterly'])->after('price_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->dropColumn('duration');
        });

        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->enum('duration', ['yearly', 'quarterly'])->nullable();
        });
    }
};
