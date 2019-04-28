<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateAlunosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('matricula', 15)->unique();
            $table->tinyInteger('pai_declarado')->default(0);
            $table->tinyInteger('pratica_ed_fisica')->default(0);
            $table->tinyInteger('irmao_na_escola')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('alunos');
    }
}
