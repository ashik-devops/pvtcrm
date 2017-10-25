<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTeamsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_teams_users', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('sales_team_id')->unsigned();
            $table->enum('role', ['MANAGER', 'MEMBER']);
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
        Schema::dropIfExists('sales_teams_users');
    }
}
