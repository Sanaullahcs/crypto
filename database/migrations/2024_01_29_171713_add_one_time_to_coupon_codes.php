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
        Schema::table('coupon_codes', function (Blueprint $table) {
            $table->boolean('one_time')->default(false);
            $table->boolean('is_used')->default(false);

        });
    }

    public function down()
    {
        Schema::table('coupon_codes', function (Blueprint $table) {
            $table->dropColumn('one_time');
            $table->dropColumn('is_used');
        });
    }
};
