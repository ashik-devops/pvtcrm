<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersCompanyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_company_addresses', function (Blueprint $table){
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->integer('customer_company_id')->unsigned();
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
        Schema::dropIfExists('customers_company_addresses');
    }
}
