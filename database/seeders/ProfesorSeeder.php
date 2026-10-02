<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profesores')->insert([
            ['id' => 1, 'nombre' => 'Ana Martínez', 'email' => 'amartinez@educa.jccm.es'],
            ['id' => 2, 'nombre' => 'Carlos López', 'email' => 'clopez@educa.jccm.es'],
            ['id' => 3, 'nombre' => 'Leonardo García', 'email' => 'lgarcia@educa.jccm.es'],
        ]);
    }
}
