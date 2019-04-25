<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateFornecedorsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cnpj', 45)->unique();
            $table->bigInteger('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->string('celular', 25)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->date('data_fundacao');
            $table->string('inscricao_estadual', 20)->nullable();
            $table->string('nome_fantasia', 150);
            $table->string('razao_social', 150);
            $table->string('segmento', 150);
            $table->string('site', 150)->nullable();
            $table->string('logo', 150)->nullable();
            $table->string('tipo', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fornecedors');
    }
}
