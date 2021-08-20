<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcourseSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcourse_schedules', function (Blueprint $table) {
            $table->id();
            $table->text('date');
            $table->string('link', 255);
            $table->unsignedBigInteger('subcourse_id');
            $table->timestamps();

            $table->foreign('subcourse_id')->references('id')->on('subcourses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcourse_schedules');
    }
}
