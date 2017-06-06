<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table){
            $table->increments('id');
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('title', 32);
            $table->string('email', 64)->unique();
            $table->string('phone_no', 32)->unique();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('customer_company_id')->unsigned()->nullable();
            $table->softDeletes();
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
