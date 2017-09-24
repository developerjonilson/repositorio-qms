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
          'especialidade_id' => 2,
          'medico_id' => 1,
      ]);

      DB::table('especialidade_medico')->insert([
          'especialidade_id' => 2,
          'medico_id' => 2,
      ]);
    }
}
