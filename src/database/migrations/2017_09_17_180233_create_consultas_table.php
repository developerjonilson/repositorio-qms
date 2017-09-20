<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo');
            $table->date('data_consulta');
            $table->integer('especialidade_id')->unsigned();
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('locals');
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
        Schema::dropIfExists('consultas');
    }
}
