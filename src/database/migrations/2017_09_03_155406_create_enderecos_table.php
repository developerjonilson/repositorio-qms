<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id_endereco');
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            //$table->integer('paciente_id')->unsigned();
            // $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id_cidade')->on('cidades')->onDelete('cascade');
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
        Schema::dropIfExists('enderecos');
    }
}
