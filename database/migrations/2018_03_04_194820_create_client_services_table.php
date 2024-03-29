<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Table to relate clients with their services and specify payment method
           Schema::create('client_services', function (Blueprint $table) {
             //primary key of client service table
             $table->increments('id');
             //foreign key from table client
             $table->integer('client_id')->unsigned();
             $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');

              //foreign key from table service
             $table->integer('service_id')->unsigned()->nullable();
             $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('set null');

              //foreign key from table payment_method
             $table->integer('payment_method')->unsigned();
             $table->foreign('payment_method')->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('restrict');

              //specify client's remainder balance for this service
             $table->Integer('balance')->default(0);
             //The required money from this client for this user
             $table->Integer('required_money')->nullable(false)->unsigned()->default(0);
              //specify the end time of the service and the the client can renew it
             $table->dateTime('end_time');
              //same client cannot have the same service twice
             // $table->primary('client_id','service_id');
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
        Schema::dropIfExists('client_services');
    }
}
