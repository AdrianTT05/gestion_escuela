<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('modulos')->insert([
            ['id' => 1, 'codigo' => 'DWES', 'nombre' => 'Desarrollo Web en Entorno Servidor', 'curso' => '2DAW', 'profesor' => '1'],
            ['id' => 2, 'codigo' => 'DWEC', 'nombre' => 'Desarrollo Web en Entorno Cliente', 'curso' => '2DAW', 'profesor' => '2'],
            ['id' => 3, 'codigo' => 'DIW', 'nombre' => 'Diseño de Interfaces Web', 'curso' => '2DAW', 'profesor' => '3'],
            ['id' => 4, 'codigo' => 'BD', 'nombre' => 'Bases de Datos', 'curso' => '1DAW', 'profesor' => '1'],
        ]);
    }
}
