<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class alumnosController extends Controller
{
    public function index()
    {
        // Simulación de datos (próximamente desde el Modelo Profesor)
        $alumnos = [
            ['id' => 1, 'nombre' => 'Ana Martínez', 'modulo' => 'DWES'],
            ['id' => 2, 'nombre' => 'Carlos López', 'modulo' => 'DWEC']
        ];

        return view('alumnos_index', compact('alumnos'));
    }
}
