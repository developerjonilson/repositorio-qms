<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name'=> 'Bruno da Silva Santos',
        'email'=> 'bruno@gmail.com',
        'password'=> bcrypt('87654321'),
        'cpf'=> '12345678901',
        'rg'=> '2007819982',
        // 'data_nascimento'=> date("Y/m/d","1998/12/10"),
        'tipo'=> 'operador',
        // 'numero_alteracao_senha'=> '0',
        // 'data_alteracao_senha'=> date("Y/m/d"),
        'endereco_id'=> 1,
        'telefone_id'=> 1,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
