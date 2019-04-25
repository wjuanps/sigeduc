<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateFuncionariosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->date('data_emissao_carteira');
            $table->integer('qtd_dependentes');
            $table->string('escolaridade', 35);
            $table->string('numero_ctps', 40);
            $table->string('numero_pis', 30);
            $table->string('serie_ctps', 40);
            $table->tinyInteger('is_usuario')->default(0);
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
        Schema::dropIfExists('funcionarios');
    }
}
