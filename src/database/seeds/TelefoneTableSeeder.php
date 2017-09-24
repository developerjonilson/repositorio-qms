<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TelefoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('telefones')->insert([
          'telefone_um' => '999410064',
          'telefone_dois' => '999410066',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('telefones')->insert([
          'telefone_um' => '999410067',
          'telefone_dois' => '999410067',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('telefones')->insert([
          'telefone_um' => '999410088',
          'telefone_dois' => '999410097',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('telefones')->insert([
          'telefone_um' => '999410021',
          'telefone_dois' => '999410023',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);

      DB::table('telefones')->insert([
          'telefone_um' => '35420021',
          'telefone_dois' => '354210023',
          'created_at'=> date("Y/m/d h:i:s"),
          'updated_at'=> date("Y/m/d h:i:s"),
      ]);
    }
}
