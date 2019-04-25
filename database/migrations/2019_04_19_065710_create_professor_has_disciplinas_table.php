<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorHasDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_has_disciplinas', function (Blueprint $table) {
            $table->bigInteger('professor_id')->unsigned();
            $table->bigInteger('disciplina_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->primary(['professor_id', 'disciplina_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professor_has_disciplinas');
    }
}
