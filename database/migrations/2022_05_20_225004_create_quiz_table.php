<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->mediumInteger('id', true);
            $table->bigInteger('course')->nullable();
            $table->string('name', 255)->nullable();
            $table->longText('intro')->nullable();
            $table->timestamp('timeopen')->nullable();
            $table->timestamp('timeclose')->nullable();
            $table->bigInteger('timelimit')->nullable();
            $table->tinyInteger('canredoquestions')->nullable()->default(0);
            $table->mediumInteger('attempts')->nullable()->default(1);
            $table->bigInteger('questionsperpage')->nullable();
            $table->tinyInteger('shuffleanswers')->nullable();
            $table->decimal('grade', 10, 0)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
