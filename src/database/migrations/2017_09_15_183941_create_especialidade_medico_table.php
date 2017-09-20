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
          $table->increments('id');
          $table->integer('especialidade_id')->unsigned();
          $table->foreign('especialidade_id')->references('id')->on('especialidades')->onDelete('cascade');
          $table->integer('medico_id')->unsigned();
          $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
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
