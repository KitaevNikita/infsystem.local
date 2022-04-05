<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummarylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summarylists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discipline_id')->index()->comment('Идентификатор дисциплины');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('student_id')->index()->comment('Идентификатор студента');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->string('interim', 1)->nullable()->comment('промежуточная аттестация');
            $table->string('estimation', 1)->nullable()->comment('отметка');
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
        Schema::dropIfExists('summarylists');
    }
}
