<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadeMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('especialidade_medico', function (Blueprint $table) {
          $table->increments('id_especialidade_medico');
          $table->integer('id_especialidade')->unsigned();
          $table->foreign('id_especialidade')->references('id_especialidade')->on('especialidades')->onDelete('cascade');
          $table->integer('id_medico')->unsigned();
          $table->foreign('id_medico')->references('id_medico')->on('medicos')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especilidade_medico');
    }
}
