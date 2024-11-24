<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidads', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); 
            $table->time('horainicio'); 
            $table->time('horafin'); 
            $table->enum('estado', ['disponible', 'terminado', 'pendiente'])->default('pendiente'); // Estado de disponibilidad
            $table->integer('cupo'); // Campo para el número de cupos disponibles
            $table->integer('libre'); // Campo para el número de cupos libres
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->foreign('user_id_medico')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('disponibilidads');
    }
}
