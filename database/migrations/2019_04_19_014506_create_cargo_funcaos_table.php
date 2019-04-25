<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateCargoFuncaosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cargo_funcaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cargo_funcao', 100)->unique();
            $table->string('descricao', 200);
            $table->tinyInteger('is_ativa')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cargo_funcaos');
    }
}
