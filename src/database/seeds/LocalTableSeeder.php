<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('locals')->insert([
          'nome_fantasia' => 'Hospital Geral',
          'numero_cnes' => '123456',
          'nome_razao_social' => '',
          'endereco_id' => 4,
          'telefone_id' => 4,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('locals')->insert([
          'nome_fantasia' => 'Hospital Geral II',
          'numero_cnes' => '123457',
          'nome_razao_social' => '',
          'endereco_id' => 5,
          'telefone_id' => 5,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

    }
}
