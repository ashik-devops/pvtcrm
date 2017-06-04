<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerCompaniesAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_companies_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_companies_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->enum('type', ['CONTACT','BILLING', 'SHIPPING']);
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
        Schema::dropIfExists('customer_companies_address');
    }
}
