<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('grade_id')->index();
            $table->foreign('grade_id')->references('id')->on('grades')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('class_id')->index();
            $table->foreign('class_id')->references('id')->on('classrooms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('status');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
