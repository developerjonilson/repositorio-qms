<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EspecialidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('especialidades')->insert([
          'codigo_especialidade' => 1,
          'nome_especialidade' => 'ACUPUNTURA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'codigo_especialidade' => 2,
          'nome_especialidade' => 'ALERGIA E IMUNOLOGIA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'codigo_especialidade' => 3,
          'nome_especialidade' => 'ANESTESIOLOGIA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
      DB::table('especialidades')->insert([
          'codigo_especialidade' => 4,
          'nome_especialidade' => 'ANGIOLOGIA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
      DB::table('especialidades')->insert([
          'codigo_especialidade' => 5,
          'nome_especialidade' => 'CANCEROLOGIA/CANCEROLOGIA CLÍNICA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
      DB::table('especialidades')->insert([
          'codigo_especialidade' => 6,
          'nome_especialidade' => 'CANCEROLOGIA/CANCEROLOGIA CIRÚRGICA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
      DB::table('especialidades')->insert([
          'codigo_especialidade' => 7,
          'nome_especialidade' => 'CANCEROLOGIA/CANCEROLOGIA CIRÚRGICA',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

    }
}
