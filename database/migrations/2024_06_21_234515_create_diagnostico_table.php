<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostico', function (Blueprint $table) {
            $table->id();
            $table->string('resultado_ia',240);
            $table->string('resultado',240);
            $table->string('estado',40);
            $table->string('confidence',40);
            $table->text('data');
            $table->unsignedBigInteger('user_id_cliente')->nullable();
            $table->foreign('user_id_cliente')->references('id')->on('users')->nullable();
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
        Schema::dropIfExists('diagnostico');
    }
}
