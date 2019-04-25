<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateDisciplinasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('disciplinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disciplina', 100)->unique();
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
        Schema::dropIfExists('disciplinas');
    }
}
