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
        'data_nascimento'=> date("Y/m/d", strtotime("12/10/1998")),
        'tipo'=> 'operador',
        'data_alteracao_senha'=> date("Y-m-d"),
        'endereco_id'=> 6,
        'telefone_id'=> 6,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('users')->insert([
        'name'=> 'Pedro da Silva',
        'email'=> 'pedro.adm@gmail.com',
        'password'=> bcrypt('87654321'),
        'cpf'=> '12345678902',
        'rg'=> '2007819983',
        'data_nascimento'=> date("Y/m/d", strtotime("12/10/1998")),
        'tipo'=> 'administrador',
        // 'numero_alteracao_senha'=> '0',
        'data_alteracao_senha'=> date("Y/m/d"),
        'endereco_id'=> 1,
        'telefone_id'=> 1,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('users')->insert([
        'name'=> 'Marcos dos Santos',
        'email'=> 'marcos@gmail.com',
        'password'=> bcrypt('87654321'),
        'cpf'=> '12345678903',
        'rg'=> '2007819984',
        'data_nascimento'=> date("Y/m/d", strtotime("12/10/1995")),
        'tipo'=> 'atendente',
        // 'numero_alteracao_senha'=> '0',
        'data_alteracao_senha'=> date("Y/m/d"),
        'endereco_id'=> 7,
        'telefone_id'=> 7,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
