<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_companies', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('website')->nullable()->unique();
            $table->string('phone_no', 32);
            $table->string('email', 64);
            $table->integer('default_contact')->unsigned()->unique()->nullable();
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
        //
        Schema::dropIfExists('customer_companies');
    }
}
