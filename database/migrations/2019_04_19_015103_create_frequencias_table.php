<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateFrequenciasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('frequencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('professor_id')->unsigned();
            $table->bigInteger('disciplina_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->date('data_frequencia');
            $table->string('anotacoes', 100)->nullable();
            $table->tinyInteger('is_presente');
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('frequencias');
    }
}
