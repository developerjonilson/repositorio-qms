<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_paciente');
            $table->string('nome_paciente');
            $table->string('sexo');
            $table->date('data_nascimento');
            $table->string('numero_cns')->unique();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('nome_mae');
            $table->string('nome_pai')->nullable();
            $table->integer('endereco_id')->unsigned();
            $table->foreign('endereco_id')->references('id_endereco')->on('enderecos')->onDelete('cascade');
            $table->integer('telefone_id')->unsigned();
            $table->foreign('telefone_id')->references('id_telefone')->on('telefones')->onDelete('cascade');
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
        Schema::dropIfExists('pacientes');
    }
}
