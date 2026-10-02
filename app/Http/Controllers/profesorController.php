<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaz\ProfesorServiceInterface;

class profesorController extends Controller
{
    private $profesorService;

    public function __construct(ProfesorServiceInterface $profesorService)
    {
        $this->profesorService = $profesorService;
    }

    public function index()
    {
        $profesores = $this->profesorService->listar();

        return view('profesor.profesores_listado', compact('profesores'));
    }

    public function show($id)
    {
        $profesor = $this->profesorService->obtener($id);

        if (!$profesor) {
            abort(404, 'Profesor no encontrado');
        }

        return view('profesor.profesor_detalle', compact('profesor'));
    }

    public function create()
    {
        return view('profesor.profesor_create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        $nuevoProfesor = $this->profesorService->crear($datos);

        if (!$nuevoProfesor) {
            abort(409, 'Ya existe un profesor con ese email');
        }

        return redirect('/profesores/created')->with('nuevoProfesor', $nuevoProfesor);
    }

    public function edit($id)
    {
        $profesor = $this->profesorService->obtener($id);

        if (!$profesor) {
            abort(404, 'Profesor no encontrado');
        }

        return view('profesor.profesor_edit', compact('profesor'));
    }

    public function update(Request $request, $id)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        $profesorActualizado = $this->profesorService->actualizar($id, $datos);

        if (!$profesorActualizado) {
            abort(404, 'Profesor no encontrado');
        }

        if ($profesorActualizado === "ya existe un profesor con ese email") {
            abort(409, 'Ya existe un profesor con ese email');
        }

        return redirect('/profesores/updated')->with('profesorActualizado', $profesorActualizado);
    }

    public function destroy($id)
    {
        $profesorEliminado = $this->profesorService->eliminar($id);

        if (!$profesorEliminado) {
            abort(404, 'Profesor no encontrado');
        }

        return redirect('/profesores/deleted')->with('profesorEliminado', $profesorEliminado);
    }
}
