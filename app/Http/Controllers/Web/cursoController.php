<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cursoController extends Controller
{
    public function index()
    {
        // Simulación de datos (próximamente desde el Modelo Profesor)
        $cursos = [
            [
                'codigo' => '2DAM',
                'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
                'turno' => 'Tarde'
            ],
            [
                'codigo' => '2DAW',
                'nombre' => 'Desarrollo de Aplicaciones Web',
                'turno' => 'Mañana'
            ]
        ];

        return view('cursos_index', compact('cursos'));
    }
}
