<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaz\ModulosServiceInterface;

class modulosController extends Controller
{
    private $modulosService;

    public function __construct(ModulosServiceInterface $modulosService)
    {
        $this->modulosService = $modulosService;
    }

    public function index()
    {
        $modulos = $this->modulosService->listar();

        return view('modulos.modulos_listado', compact('modulos'));
    }

    public function show($id)
    {
        $modulo = $this->modulosService->obtener($id);

        if (!$modulo) {
            abort(404, 'Módulo no encontrado');
        }

        return view('modulos.modulos_detalle', compact('modulo'));
    }

    public function create()
    {
        return view('modulos.modulos_create');
    }

    public function store(Request $request)
    {
        $nuevoModulo = $this->modulosService->crear(
            $request->only(['codigo', 'nombre', 'curso', 'profesor'])
        );

        if ($nuevoModulo === 'codigo_duplicado') {
            abort(409, 'Ya existe un módulo con ese código');
        }

        if ($nuevoModulo === 'profesor_no_encontrado') {
            abort(422, 'El profesor indicado no existe');
        }

        return redirect('/modulos/created')->with('nuevoModulo', $nuevoModulo);
    }

    public function edit($id)
    {
        $modulo = $this->modulosService->obtener($id);

        if (!$modulo) {
            abort(404, 'Módulo no encontrado');
        }

        return view('modulos.modulos_edit', compact('modulo'));
    }

    public function update(Request $request, $id)
    {
        $moduloActualizado = $this->modulosService->actualizar($id, $request->only(['codigo', 'nombre', 'curso', 'profesor']));

        if (!$moduloActualizado) {
            abort(404, 'Módulo no encontrado');
        }

        return redirect('/modulos/updated')->with('moduloActualizado', $moduloActualizado);
    }

    public function destroy($id)
    {
        $moduloEliminado = $this->modulosService->eliminar($id);

        if (!$moduloEliminado) {
            abort(404, 'Módulo no encontrado');
        }

        return redirect('/modulos/deleted')->with('moduloEliminado', $moduloEliminado);
    }
}
