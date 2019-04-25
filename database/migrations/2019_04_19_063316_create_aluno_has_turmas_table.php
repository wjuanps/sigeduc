<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateAlunoHasTurmasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aluno_has_turmas', function (Blueprint $table) {
            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->primary(['turma_id', 'aluno_id']);
            $table->integer('ano');
            $table->tinyInteger('is_repetente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aluno_has_turmas');
    }
}
