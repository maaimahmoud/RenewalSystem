<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //table to specify avaliable payment methods so the client can choose one of them for his service
        Schema::create('payment_methods', function (Blueprint $table) {
            //payment method primary key
            $table->increments('id');
            //payment method title (annual etc.) (required)
            $table->string('title')->nullable(false)->unique();
            //number of months until due date comes and then client has to pay the cost (required)
            $table->Integer('months')->nullable(false)->unique()->unsigned();

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
        Schema::dropIfExists('payment_methods');
    }
}
