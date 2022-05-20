<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlobjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slobjects', function (Blueprint $table) {
            $table->integer('id', true)->unique('slobjects_id_uindex');
            $table->string('UUID', 255)->nullable();
            $table->string('owner', 35)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('group', 255)->nullable();
            $table->string('type', 25)->nullable();
            $table->string('slurl', 255)->nullable();
            $table->tinyInteger('active')->nullable()->default(0);
            $table->timestamps();
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slobjects');
    }
}
