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
          'nome_especialidade' => 'Dermatologia',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'nome_especialidade' => 'Ortopedia e Traumatologia',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'nome_especialidade' => 'Otorrinolaringologia',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'nome_especialidade' => 'Psiquiatria',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'nome_especialidade' => 'Urologia',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('especialidades')->insert([
          'nome_especialidade' => 'Pediatria',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
