<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateEnderecosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bairro', 100)->nullable();
            $table->string('cep', 12)->nullable();
            $table->string('cidade', 150)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('rua', 100)->nullable();
            $table->string('uf', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enderecos');
    }
}
