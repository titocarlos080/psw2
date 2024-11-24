<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecomendacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomendaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnostico_id');
            $table->text('recomendacion')->notNullable();
            $table->string('nombre_medico')->nullable(); // Añadir campo para el nombre del médico
            $table->string('user_id_cliente')->nullable();
            $table->timestamps();

            // Establecer la relación con la tabla diagnostico
            $table->foreign('diagnostico_id')
                  ->references('id')
                  ->on('diagnostico')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recomendaciones');
    }
}