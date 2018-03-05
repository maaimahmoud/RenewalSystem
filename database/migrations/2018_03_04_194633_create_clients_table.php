<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Table to record Clients' information
        Schema::create('clients', function (Blueprint $table) {
            //client primary key
            $table->increments('id');
            //client's name (required)
            $table->string('name')->nullable(false);
            //client's email (required) and two clients cannot have the same email
            $table->string('email')->nullable(false);
            //client's phone number (required) and two clients cannot have the same phone number
            $table->smallInteger('phone_number')->unique();
            //client's adress
            $table->string('address')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
