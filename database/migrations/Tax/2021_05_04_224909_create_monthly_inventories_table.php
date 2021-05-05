<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_inventories', function (Blueprint $table) {
            $table->id();
            $table->string("month_name")->nullable();
            $table->integer("number_of_days")->nullable();
            $table->integer("gst")->nullable();
            $table->integer("amount_earned")->nullable();
            $table->integer("total_order")->nullable();
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
        Schema::dropIfExists('monthly_inventories');
    }
}
