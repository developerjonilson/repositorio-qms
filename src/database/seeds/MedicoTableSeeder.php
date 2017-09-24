<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MedicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('medicos')->insert([
          'nome_medico' => 'Alex Paulo da Silva',
          'numero_crm' => '123456',
          'endereco_id' => 2,
          'telefone_id' => 2,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('medicos')->insert([
          'nome_medico' => 'Ana Beatriz Ferreira',
          'numero_crm' => '123459',
          'endereco_id' => 3,
          'telefone_id' => 3,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
