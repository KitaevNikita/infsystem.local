<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->index()->nullable()->comment('Идентификатор группы');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name_of_the_discipline', 255)->comment('название дисциплины');
            $table->string('teacher', 255)->comment('преподаватель');
            $table->integer('number_hours')->nullable()->comment('количество часов');
            $table->string('certification', 255)->comment('промежуточная аттестация');
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
        Schema::dropIfExists('disciplines');
    }
}
