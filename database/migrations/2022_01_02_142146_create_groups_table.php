<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialization_id')->index()->comment('Идентификатор специальности');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('classteacher_id')->index()->comment('Идентификатор классного руководителя');
            $table->foreign('classteacher_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('namegroup', 5)->comment('Название группы');
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
        Schema::dropIfExists('groups');
    }
}
