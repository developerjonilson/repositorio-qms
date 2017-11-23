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
         'rua' => 'AV 7 DE SETEMBRO',
         'numero' => 756,
         'bairro' => 'CENTRO',
         'cidade_id' => 1,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'FRANCISCO DA SILVA PEREIRA COSTA',
         'numero' => 50,
         'bairro' => 'BELA VISTA',
         'cidade_id' => 2,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'MARECHAL DEODORIO DA FONSECA II',
         'numero' => 800,
         'bairro' => 'BELA VISTA',
         'cidade_id' => 3,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'MARECHAL DEODORIO DA FONSECA II',
         'numero' => 900,
         'bairro' => 'CENTRO',
         'cidade_id' => 4,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'MARECHAL DEODORIO DA FONSECA II',
         'numero' => 900,
         'bairro' => 'CENTRO',
         'cidade_id' => 4,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'FRANCISCO ARRAIS MAIA',
         'numero' => 460,
         'bairro' => 'CENTRO',
         'cidade_id' => 5,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'FRANCISCO ARRAIS MAIA',
         'numero' => 70,
         'bairro' => 'CENTRO',
         'cidade_id' => 6,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('enderecos')->insert([
         'rua' => 'FRANCISCO ARRAIS MAIA',
         'numero' => 90,
         'bairro' => 'CENTRO',
         'cidade_id' => 7,
         'created_at'=> date("Y/m/d h:i:s"),
         'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
