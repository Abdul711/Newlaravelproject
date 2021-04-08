<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('color_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('mrp')->nullable();
            $table->string('price')->nullable();
            $table->string('product_id')->nullable();
            $table->string('sku')->nullable();

            $table->string('attr_image')->nullable();
            $table->string('price_after_tax')->nullable();
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
        Schema::dropIfExists('product_attributes');
    }
}
