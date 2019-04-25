<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 
 * @author Juan Soares
 */
class CreateMaterialDeConsumosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('material_de_consumos', function (Blueprint $table) {
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
        Schema::dropIfExists('material_de_consumos');
    }
}
