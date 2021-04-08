<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poleras', function (Blueprint $table) {
            $table->bigIncrements('idPolera');
            $table->string('skuPolera', 8);
            $table->string('marcaPolera', 30);
            $table->unsignedBigInteger('colorPolera');
            $table->unsignedBigInteger('tallaPolera');
            $table->Integer('precioPolera');
            $table->Integer('stockPolera');
            $table->unsignedBigInteger('usuarioInfoPolera');
            $table->string('fechaLastUpdPolera');
            $table->string('horaLastUpdPolera');

            $table->foreign('colorPolera')->references('idColor')->on('colors');
            $table->foreign('tallaPolera')->references('idTalla')->on('tallas');
            $table->foreign('usuarioInfoPolera')->references('idUsuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poleras');
    }
}
