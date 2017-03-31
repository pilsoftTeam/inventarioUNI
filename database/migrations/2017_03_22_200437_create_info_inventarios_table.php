<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio')->unique();
            $table->unsignedInteger('idRevisor');
            $table->foreign('idRevisor')->references('id')->on('usuarios');
            $table->unsignedInteger('idCampus');
            $table->foreign('idCampus')->references('id')->on('campus');
            $table->unsignedInteger('idCustodio');
            $table->foreign('idCustodio')->references('id')->on('custodios');
            $table->integer('numeroPabellon');
            $table->integer('numeroPiso');
            $table->string('codigoUbicacion');
            $table->string('rutaImagenLayout');
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
        Schema::dropIfExists('info_inventarios');
    }
}
