<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number_of_mcqs');//of 1 mark each
            $table->unsignedInteger('number_of_3_marks_questions');
            $table->unsignedInteger('number_of_5_marks_questions');
            $table->date('start_date');
            $table->time('start_time');
            $table->unsignedInteger('max_duration');//In minutes
            $table->unsignedInteger('pass_percentage');
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
        Schema::dropIfExists('criterias');
    }
}
