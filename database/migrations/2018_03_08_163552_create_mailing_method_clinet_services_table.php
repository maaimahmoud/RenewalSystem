<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingMethodClinetServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table to relate every service provided to a client with the mailing time he want before payment
        Schema::create('mailing_method_clinet_services', function (Blueprint $table) {
            //foreign keys from mailing methods, client sercices table
            $table->Integer('mailing_methods_id')->unsigned()->nullable();
            $table->foreign('mailing_methods_id')->references('id')->on('mailing_methods')->onUpdate('cascade')->onDelete('restrict');

            //foreign key from table service
            $table->integer('client_services_id')->unsigned()->nullable();
            $table->foreign('client_services_id')->references('id')->on('client_services')->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('mailing_method_clinet_services');
    }
}
