<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcografiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecografias', function (Blueprint $table) {
            $table->id();
            $table->string('path',240);
            $table->unsignedBigInteger('id_diagnostico')->nullable();
            $table->foreign('id_diagnostico')->references('id')->on('diagnostico')->nullable();
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
        Schema::dropIfExists('ecografias');
    }
}
