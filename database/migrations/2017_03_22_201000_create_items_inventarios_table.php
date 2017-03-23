<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idInfoInventario');
            $table->foreign('idInfoInventario')->references('id')->on('info_inventarios');
            $table->string('codigoAnterior');
            $table->string('codigoNuevo');
            $table->longText('descripcion');
            $table->string('marca');
            $table->string('modelo');
            $table->string('numeroSerie');
            $table->string('rutaImagen');
            $table->enum('estado', ['bueno', 'malo', 'regular']);
            $table->longText('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_inventarios');
    }
}
