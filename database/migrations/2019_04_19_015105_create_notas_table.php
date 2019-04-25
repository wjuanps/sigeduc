<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateNotasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('professor_id')->unsigned();
            $table->bigInteger('disciplina_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->enum('avaliacao', ['1ª Avaliação', '2ª Avaliação', '3ª Avaliação', '4ª Avaliação', '1ª Recuperação', '2ª Recuperação']);
            $table->string('anotacoes', 100)->nullable();
            $table->double('nota', 6, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notas');
    }
}
