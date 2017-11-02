<?php

use Illuminate\Database\Seeder;

class CalendarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('calendarios')->insert([
          'data' => '2017-11-28',
          'especialidade_id' => 2,
          'medico_id' => 1,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('calendarios')->insert([
          'data' => '2017-11-29',
          'especialidade_id' => 2,
          'medico_id' => 2,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('calendarios')->insert([
          'data' => '2017-11-30',
          'especialidade_id' => 2,
          'medico_id' => 1,
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
