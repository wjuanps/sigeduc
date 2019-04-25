<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateFuncionarioHasCargosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('funcionario_has_cargos', function (Blueprint $table) {
            $table->bigInteger('funcionario_id')->unsigned();
            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->foreign('cargo_id')->references('id')->on('cargo_funcaos');
            $table->primary(['funcionario_id', 'cargo_id']);
            $table->integer('carga_horaria')->nullable();
            $table->tinyInteger('is_cargo_atual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('funcionario_has_cargos');
    }
}
