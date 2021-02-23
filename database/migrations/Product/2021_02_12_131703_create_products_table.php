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
            $table->string('product_name')->nullable();
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('image')->nullable();
            $table->string('keyword')->nullable();
            $table->string('featured')->nullable();
            $table->string('discounted')->nullable();
            $table->string('trending')->nullable();
      
         
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
