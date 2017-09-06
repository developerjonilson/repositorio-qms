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
        // $this->call(UsersTableSeeder::class);
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
           'numero' => 100,
           'bairro' => 'Bela Vista',
           'cidade_id' => 1,
        ]);

        DB::table('users')->insert([
          'name'=> 'Pedro Admin',
          'email'=> 'pedro.admin@gmail.com',
          'password'=> bcrypt('123456'),
          'cpf'=> '12345678902',
          'rg'=> '2007819984',
          'tipo'=> 'administrador',
          'endereco_id'=> 1,
          'telefones_id'=> 1,
        ]);
    }
}
