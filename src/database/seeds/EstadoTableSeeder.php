<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('estados')->insert([
          'nome_estado' => 'CE',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

    }
}
