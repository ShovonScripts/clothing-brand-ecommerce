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
        if (! Schema::hasColumn('variations', 'weight_id')) {
            Schema::table('variations', function (Blueprint $table) {
                $table->unsignedBigInteger('weight_id')->nullable()->after('color_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('variations', 'weight_id')) {
            Schema::table('variations', function (Blueprint $table) {
                $table->dropColumn('weight_id');
            });
        }
    }
};
