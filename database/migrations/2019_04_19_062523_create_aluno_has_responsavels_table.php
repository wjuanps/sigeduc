<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateAlunoHasResponsavelsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aluno_has_responsavels', function (Blueprint $table) {
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('responsavel_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('responsavel_id')->references('id')->on('responsavels');
            $table->primary(['aluno_id', 'responsavel_id']);
            $table->tinyInteger('mora_com_filho');
            $table->tinyInteger('outro_filho_na_escola')->nullable();
            $table->string('parentesco', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('aluno_has_responsavels');
    }
}
