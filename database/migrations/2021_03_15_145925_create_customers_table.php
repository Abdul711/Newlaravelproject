<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->integer('customer_status')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_password')->nullable();
            $table->string('customer_otp')->nullable();
            $table->string('customer_rand_str')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->string('customer_verified')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
