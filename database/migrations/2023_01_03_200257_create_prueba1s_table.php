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
        Schema::create('prueba1s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Numero');
            $table->string('Nombre');
            $table->longText('Descripcion');
            $table->integer('Default')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prueba1s');
    }
};
