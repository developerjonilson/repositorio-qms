<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsuarioTableSeeder::class);

        DB::table('telefones')->insert([
           'telefone_um' => '999410067',
           'telefone_dois' => '999410067',
        ]);

        DB::table('estados')->insert([
           'nome_estado' => 'Ceará',
        ]);

        DB::table('cidades')->insert([
           'nome_cidade' => 'Milagres',
           'cep' => '63250000',
           'estado_id' => 1,
        ]);

        DB::table('enderecos')->insert([
           'rua' => 'Francisco da Silva Pereira Costa',
           'numero' => 50,
           'bairro' => 'Bela Vista',
           'cidade_id' => 1,
        ]);

        DB::table('users')->insert([
          'name'=> 'Bruno da Silva Santos',
          'email'=> 'bruno@gmail.com',
          'password'=> bcrypt('12345678'),
          'cpf'=> '12345678901',
          'rg'=> '2007819982',
          // 'data_nascimento'=> date("Y/m/d","1998/12/10"),
          'tipo'=> 'operador',
          // 'numero_alteracao_senha'=> '0',
          // 'data_alteracao_senha'=> date("Y/m/d"),
          'endereco_id'=> 1,
          'telefones_id'=> 1,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
        ]);

    }
}
