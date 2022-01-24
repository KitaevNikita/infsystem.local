<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discipline_id')->index()->comment('Идентификатор дисциплины');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date')->nullable()->comment('дата');
            $table->string('topic', 255)->nullable()->comment('тема');
            $table->string('type', 255)->nullable()->comment('тип');
            $table->integer('number_of_hours')->comment('количество часов');
            $table->timestamps();
        });

        Schema::create('students_lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->index()->comment('Идентификатор студента');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('lesson_id')->index()->comment('Идентификатор урока');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
