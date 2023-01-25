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
        Schema::create('proyecto_cots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_worker');
            $table->string('id_assistant');
            $table->string('product_list');
            $table->integer('id_client');
            $table->string('id_proyect');
            $table->string('city');
            $table->integer('id_father')->nullable();
            $table->integer('active')->default(0);
            $table->integer('cancel')->default(0);
            $table->integer('value');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('proyecto_cots');
    }
};
