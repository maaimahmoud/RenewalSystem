<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Table to record Services' information and cost
        Schema::create('services', function (Blueprint $table) {
            //service primary key
            $table->increments('id');
            //service title (required)
            $table->string('title')->nullable(false)->unique();

            //foreign key from table service service_categories to specify which category the service belongs to
           $table->integer('category_id')->unsigned()->nullable();
           $table->foreign('category_id')->references('id')->on('service_categories')->onUpdate('cascade')->onDelete('set null');

            //specify how much client will pay to get this service
            $table->float('cost', 8, 2)->unsigned()->default(0);
            //foreign key from table payment_method
            $table->integer('payment_method_id')->unsigned();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onUpdate('restrict')->onDelete('restrict');


            //Short description of the service and what it provides to the client
            $table->mediumText('description')->nullable(false);
            
            $table->longText('email_template');
            
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
        Schema::dropIfExists('services');
    }
}
