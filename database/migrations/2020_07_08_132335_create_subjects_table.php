<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('code');
            $table->text('semester');
            $table->text('lecture_hours_per_week')->nullable();
            $table->text('tutorial_hours_per_week')->nullable();
            $table->text('practical_hours_per_week')->nullable();
            $table->text('ss_hours_per_week')->nullable();
            $table->text('credits');
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
        Schema::dropIfExists('subjects');
    }
}
