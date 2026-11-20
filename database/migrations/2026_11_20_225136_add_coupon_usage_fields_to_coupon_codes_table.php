<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupon_codes', function (Blueprint $table) {
            $table->unsignedInteger('usage_limit')->nullable()->after('discount_type');
            $table->unsignedInteger('usage_limit_per_user')->nullable()->after('usage_limit');
            $table->unsignedInteger('used_count')->default(0)->after('usage_limit_per_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupon_codes', function (Blueprint $table) {
            //
        });
    }
};
