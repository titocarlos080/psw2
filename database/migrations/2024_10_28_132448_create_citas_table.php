<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); 
            $table->time('hora'); 
            $table->text('detalles')->nullable(); 
            $table->enum('estado', ['confirmado','pendiente', 'finalizado', 'cancelado', 'modificado'])->default('confirmado'); 
            $table->unsignedBigInteger('user_id_cliente')->nullable();
            $table->foreign('user_id_cliente')->references('id')->on('users')->nullable();

            $table->unsignedBigInteger('disponibilidad_id')->nullable();
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidads')->nullable();

            $table->timestamps(); // Campos para created_at y updated_at
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
