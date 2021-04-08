<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('image')->nullable();
            $table->string('lead_time')->nullable();
            $table->string('model')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('is_promo')->nullable();
            $table->longText('is_featured')->nullable();
            $table->longText('is_discounted')->nullable();
            $table->longText('is_tranding')->nullable();
            $table->longText('warranty')->nullable();
            $table->integer('status')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('tax_id')->nullable();

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
        Schema::dropIfExists('products');
    }
}
