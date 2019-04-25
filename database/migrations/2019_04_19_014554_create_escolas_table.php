<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateEscolasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('escolas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->string('celular', 35)->nullable();
            $table->string('contrato', 45)->unique();
            $table->string('email', 100)->nullable();
            $table->string('escola_nome', 100)->unique();
            $table->string('telefone', 35)->nullable();
            $table->string('escola_tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('escolas');
    }
}
