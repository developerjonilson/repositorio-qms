<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cidades')->insert([
          'nome_cidade' => 'Milagres',
          'cep' => '63250000',
          'estado_id' => 1,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('cidades')->insert([
          'nome_cidade' => 'Milagres',
          'cep' => '63250000',
          'estado_id' => 2,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('cidades')->insert([
          'nome_cidade' => 'Milagres',
          'cep' => '63250000',
          'estado_id' => 3,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('cidades')->insert([
          'nome_cidade' => 'Milagres',
          'cep' => '63250000',
          'estado_id' => 4,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('cidades')->insert([
          'nome_cidade' => 'Milagres',
          'cep' => '63250000',
          'estado_id' => 5,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
