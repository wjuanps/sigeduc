<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateBemPatrimonialsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bem_patrimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bem_patrimonials');
    }
}
