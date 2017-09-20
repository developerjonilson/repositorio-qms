<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EnderecoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('enderecos')->insert([
         'rua' => 'Av. 7 de setembro',
         'numero' => 756,
         'bairro' => 'Centro',
         'cidade_id' => 1,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'Francisco da Silva Pereira Costa',
         'numero' => 50,
         'bairro' => 'Bela Vista',
         'cidade_id' => 2,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'Marechal Deodoro da Fonseca',
         'numero' => 800,
         'bairro' => 'Bela Vista',
         'cidade_id' => 3,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'Marechal Deodoro da Fonseca II',
         'numero' => 900,
         'bairro' => 'Centro',
         'cidade_id' => 4,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'Marechal Deodoro da Fonseca II',
         'numero' => 900,
         'bairro' => 'Centro',
         'cidade_id' => 4,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'Francisco Arrais Maia',
         'numero' => 460,
         'bairro' => 'Centro',
         'cidade_id' => 5,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
