<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreatePessoasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->string('celular', 25)->nullable();
            $table->string('cpf', 25)->unique();
            $table->date('data_nascimento');
            $table->string('email', 100)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('rg', 25)->nullable();
            $table->string('nacionalidade', 100)->nullable();
            $table->string('naturalidade', 100)->nullable();
            $table->string('nome', 100);
            $table->enum('sexo', ['I', 'M', 'F']);
            $table->string('telefone', 20)->nullable();
            $table->string('naturalidade_uf', 2)->nullable();
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
        Schema::dropIfExists('pessoas');
    }
}
