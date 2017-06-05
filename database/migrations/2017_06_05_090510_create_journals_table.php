<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['Due', 'Done', 'Cancelled']);
            $table->enum('priority', ['Critical', 'High', 'Medium', 'Low']);
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
        Schema::dropIfExists('journals');
    }
}
