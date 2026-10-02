<?php

namespace App\Repositories\Eloquent;

use App\Models\Profesor;
use App\Repositories\Interfaz\ProfesorRepositoryInterface;

class ProfesorEloquentRepository implements ProfesorRepositoryInterface
{
    public function todos()
    {
        return Profesor::all();
    }

    public function buscarPorId($id)
    {
        return Profesor::find($id);
    }

    public function buscarPorEmail($email)
    {
        return Profesor::where('email', $email)->first();
    }

    public function crear($datos)
    {
        return Profesor::create($datos);
    }

    public function actualizar($id, $datos)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return null;
        }

        $profesor->update($datos);

        return $profesor;
    }

    public function eliminar($id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return null;
        }

        $profesor->delete();

        return $profesor;
    }
}
