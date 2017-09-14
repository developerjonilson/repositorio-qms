<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->date('data_nascimento')->default('1998/12/10');
            $table->string('tipo');
            $table->string('numero_alteracao_senha')->default('0');
            $table->date('data_alteracao_senha')->default('2017/09/10');
            // $table->string('telefone_um')->nullable();
            // $table->string('telefone_dois')->nullable();
            $table->integer('endereco_id')->unsigned();
            $table->integer('telefone_id')->unsigned();
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');;
            $table->foreign('telefone_id')->references('id')->on('telefones')->onDelete('cascade');;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
