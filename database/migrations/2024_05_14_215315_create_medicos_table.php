<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('nombre',30);
            $table->string('a_paterno',30);
            $table->string('a_materno',30);
            $table->string('especialidad',80);
            $table->string('sexo',1);
            $table->integer('telefono');
            $table->string('direccion',80)->nullable();
            $table->string('estado',1)->nullable();
                                                //nulo porsi no tiene usuario , pero si es personal
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('medicos');
    }
}
