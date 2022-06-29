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
        Schema::create('equipamientos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Modelo');
            $table->string('Tipo');
            $table->string('Marca');
            $table->string('Categoria');
            $table->string('Talla');
            $table->string('DetalleEquipamiento');
            $table->integer('Anio');
            $table->float('Precio');
            $table->string('Foto');
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
        Schema::dropIfExists('equipamientos');
    }
};
