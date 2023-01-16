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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('correo');
            $table->string('departamento');
            $table->string('doc_index')->nullable();
            $table->unsignedInteger('id_rol')->unsigned();
            $table->string('folio')->nullable();
            $table->foreign('id_rol')->references('id')->on('rols')->onDelete('cascade'); // Padre e hijo eliminados
            $table->string('token');
            $table->longText('password');
            $table->integer('sesion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradors');
    }
};
