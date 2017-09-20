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
            $table->text('description');
            $table->integer('customer_id')->unsigned();
            $table->integer('prev_journal_id')->unsigned()->nullable(); //origin; prev node
            $table->integer('next_journal_id')->unsigned()->nullable(); //followup; next node
            $table->integer('journalable_id')->unsigned()->nullable(); //Prev node
            $table->string('journalable_type')->nullable();
            $table->dateTime('log_date');
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
