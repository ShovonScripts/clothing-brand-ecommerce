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
        Schema::table('orders', function (Blueprint $table) {
            // First, check for existing duplicates and resolve them
            $duplicates = DB::table('orders')
                ->select('invoice_no', DB::raw('count(*) as count'))
                ->groupBy('invoice_no')
                ->having('count', '>', 1)
                ->pluck('invoice_no');
            
            foreach ($duplicates as $invoiceNo) {
                $orders = DB::table('orders')
                    ->where('invoice_no', $invoiceNo)
                    ->orderBy('id')
                    ->get();
                
                $count = 0;
                foreach ($orders as $order) {
                    if ($count === 0) {
                        $count++;
                        continue; // Keep first one
                    }
                    DB::table('orders')
                        ->where('id', $order->id)
                        ->update(['invoice_no' => $invoiceNo . '-' . $count++]);
                }
            }
            
            $table->unique('invoice_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
