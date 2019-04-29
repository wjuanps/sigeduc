<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateTurmasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('turmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('escola_id')->unsigned();
            $table->foreign('escola_id')->references('id')->on('escolas');
            $table->string('nome_turma', 25)->unique(); 
            $table->string('serie', 10);
            $table->string('turno', 15);
            $table->string('modalidade', 30);
            $table->integer('ano');
            $table->string('descriao_turma', 100)->nullable();
            $table->string('descricao_serie', 100)->nullable();
            $table->dateTime('cancelado_em')->nullable();
            $table->dateTime('desativada_em')->nullale();
            $table->tinyInteger('is_cancelada')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('turmas');
    }
}
