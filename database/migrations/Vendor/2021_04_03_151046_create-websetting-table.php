<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
     Schema::create('web_setting', function (Blueprint $table) {
            $table->id();
            $table->string('min_cart_amt')->nullable();
            $table->string('free_delivery_cart')->nullable();
            $table->string('discount_on_first')->nullable();
            $table->string('no_of_order')->nullable();
            $table->integer('web_status')->nullable();
            $table->integer('referral_amount')->nullable();
            $table->integer('sign_up_reward')->nullable();
            $table->integer('point_reward_per')->nullable();
            $table->integer('website_email')->nullable();
            $table->integer('website_mobile')->nullable();
            $table->string('return_referal_per')->nullable();
            $table->string('point_amount')->nullable();
            $table->string('number_of_order_for_referal')->nullable();
            $table->string('income_tax')->nullable();
            $table->string('company_address')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
