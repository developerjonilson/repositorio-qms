<?php

use Illuminate\Database\Seeder;

class PeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('periodos')->insert([
        'nome' => 'Manhã',
        'total_consultas' => 20,
        'vagas_disponiveis' => 20,
        'calendario_id' => 1,
        'local_id' => 1,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('periodos')->insert([
        'nome' => 'Manhã',
        'total_consultas' => 20,
        'vagas_disponiveis' => 20,
        'calendario_id' => 2,
        'local_id' => 1,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('periodos')->insert([
        'nome' => 'Tarde',
        'total_consultas' => 20,
        'vagas_disponiveis' => 18,
        'calendario_id' => 1,
        'local_id' => 2,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('periodos')->insert([
        'nome' => 'Tarde',
        'total_consultas' => 20,
        'vagas_disponiveis' => 15,
        'calendario_id' => 2,
        'local_id' => 2,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('periodos')->insert([
        'nome' => 'Noite',
        'total_consultas' => 20,
        'vagas_disponiveis' => 10,
        'calendario_id' => 3,
        'local_id' => 1,
        'created_at'=> date("Y/m/d h:i:s"),
        'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
