<?php

use Illuminate\Database\Seeder;

class EspecialidadeMedicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('especialidade_medico')->insert([
          'id_especialidade' => 2,
          'id_medico' => 1,
      ]);

      DB::table('especialidade_medico')->insert([
          'id_especialidade' => 2,
          'id_medico' => 2,
      ]);
    }
}
