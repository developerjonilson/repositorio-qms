<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id_periodo');
            $table->string('nome');
            $table->integer('total_consultas');
            $table->integer('vagas_disponiveis');
            $table->integer('calendario_id')->unsigned();
            $table->foreign('calendario_id')->references('id_calendario')->on('calendarios');
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
        Schema::dropIfExists('periodos');
    }
}
