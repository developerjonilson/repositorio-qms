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
            $table->increments('id_consulta');

            $table->integer('codigo_consulta');
            $val = 0;
            $table->integer('system_status')->default($val);

            $bool = 'false';
            $table->string('status_atendimento')->default($bool);

            $table->integer('calendario_id')->unsigned();
            $table->foreign('calendario_id')->references('id_calendario')->on('calendarios');

            $table->integer('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('id_periodo')->on('periodos');

            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');

            $table->integer('especialidade_id')->unsigned();
            $table->foreign('especialidade_id')->references('id_especialidade')->on('especialidades');

            $table->integer('medico_id')->unsigned();
            $table->foreign('medico_id')->references('id_medico')->on('medicos');

            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id_local')->on('locals');

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
