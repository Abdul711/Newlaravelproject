<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('orders_status')->nullable();
            $table->string("customer_email")->nullable();
            $table->string("customer_address")->nullable();
            $table->string("customer_phone")->nullable();
            $table->string("total_price")->nullable();
            $table->string("coupon_code")->nullable();
            $table->string('final_price')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('coupon_value')->nullable();
            $table->string('gst')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('special_note')->nullable();
            $table->string('customer_payment')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('delivery_expected_time')->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
            
        });
    }

    /**
or     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
