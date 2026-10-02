<?php

namespace App\Repositories\Db;

use App\Repositories\Interfaz\ProfesorRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProfesorDbRepository implements ProfesorRepositoryInterface
{
    public function todos()
    {
        return DB::table('profesores')->get();
    }

    public function buscarPorId($id)
    {
        return DB::table('profesores')->find($id);
    }

    public function buscarPorEmail($email)
    {
        return DB::table('profesores')->where('email', $email)->first();
    }

    public function crear($datos)
    {
        $id = DB::table('profesores')->insertGetId($datos);

        return DB::table('profesores')->find($id);
    }

    public function actualizar($id, $datos)
    {
        $profesor = DB::table('profesores')->find($id);

        if (!$profesor) {
            return null;
        }

        DB::table('profesores')->where('id', $id)->update($datos);

        return DB::table('profesores')->find($id);
    }

    public function eliminar($id)
    {
        $profesor = DB::table('profesores')->find($id);

        if (!$profesor) {
            return null;
        }

        DB::table('profesores')->where('id', $id)->delete();

        return $profesor;
    }
}
