<?php

namespace App\Repositories\Eloquent;

use App\Models\Modulos;
use App\Repositories\Interfaz\ModulosRepositoryInterface;

class ModulosEloquentRepository implements ModulosRepositoryInterface
{
    public function todos()
    {
        return Modulos::all();
    }

    public function buscarPorId($id)
    {
        return Modulos::find($id);
    }

    public function buscarPorCodigo($codigo)
    {
        return Modulos::where('codigo', $codigo)->first();
    }

    public function crear($datos)
    {
        return Modulos::create($datos);
    }

    public function actualizar($id, $datos)
    {
        $modulos = Modulos::find($id);

        if (!$modulos) {
            return null;
        }

        $modulos->update($datos);

        return $modulos;
    }

    public function eliminar($id)
    {
        $modulos = Modulos::find($id);

        if (!$modulos) {
            return null;
        }

        $modulos->delete();

        return $modulos;
    }
}
