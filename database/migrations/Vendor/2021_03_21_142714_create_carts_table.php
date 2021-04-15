<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

         
            $table->integer("product_id")->nullable();
            $table->integer("attr_id")->nullable();
            $table->integer("user_id")->nullable();
            $table->integer("qty")->nullable();
            $table->longtext("ip_add")->nullable();
            $table->string("user_type")->nullable();
            $table->string("point")->nullable();

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
        Schema::dropIfExists('carts');
    }
}
