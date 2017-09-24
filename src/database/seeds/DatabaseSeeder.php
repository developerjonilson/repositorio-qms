<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TelefoneTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(CidadeTableSeeder::class);
        $this->call(EnderecoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MedicoTableSeeder::class);
        $this->call(LocalTableSeeder::class);
        $this->call(EspecialidadeTableSeeder::class);
        $this->call(CalendarioTableSeeder::class);
        $this->call(PeriodoTableSeeder::class);
        $this->call(EspecialidadeMedicoTableSeeder::class);

    }
}
