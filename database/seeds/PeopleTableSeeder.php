<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('people')->insert([
            'nombre' => 'felix',
            'correo' => 'felixiugt@gmail.com',
            'cedula' => '123456',
            'cargo' => 'administrador',
        ]);
    }
}
