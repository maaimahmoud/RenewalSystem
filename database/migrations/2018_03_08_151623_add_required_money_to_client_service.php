<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequiredMoneyToClientService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add column to save required money of each service
        Schema::table('client_services', function (Blueprint $table) {
            $table->Integer('required_money')->nullable(false)->unsigned()->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //delete column from the table
        Schema::table('client_services', function (Blueprint $table) {
            $table->dropColumn('required_money');
        });
    }
}
