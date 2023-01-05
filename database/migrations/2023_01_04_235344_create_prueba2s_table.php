<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prueba2s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Numero')->unsigned();
            $table->string('Pais');
            $table->string('Estado');
            $table->foreign('Numero')->references('Numero')->on('prueba1s')->onDelete('cascade'); // Padre e hijo eliminados
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prueba2s');
    }
};
