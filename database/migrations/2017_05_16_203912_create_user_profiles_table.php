<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->string('initial',8);
            $table->string('primary_phone_no',32)->unique();
            $table->string('secondary_phone_no',32)->nullable();
            $table->string('address_line_1',128);
            $table->string('address_line_2',128)->nullable();
            $table->string('city',32);
            $table->string('state',32);
            $table->string('country',32);
            $table->string('zip',8);
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
        Schema::dropIfExists('user_profile');
    }
}
