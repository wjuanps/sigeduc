<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateFormacaosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('formacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->integer('ano_inicio');
            $table->integer('ano_termino');
            $table->string('curso', 50);
            $table->string('diploma', 100)->nullable();
            $table->string('instituicao', 70);
            $table->string('titulo', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('formacaos');
    }
}
