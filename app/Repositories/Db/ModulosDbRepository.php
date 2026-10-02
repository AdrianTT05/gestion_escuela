<?php

namespace App\Repositories\Db;
use App\Repositories\Interfaz\ModulosRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ModulosDbRepository implements ModulosRepositoryInterface
{
    public function todos()
    {
        return DB::table('modulos')->get();
    }

    public function buscarPorId($id)
    {
        return DB::table('modulos')->find($id);
    }

    public function buscarPorCodigo($codigo)
    {
        return DB::table('modulos')->where('codigo', $codigo)->first();
    }

    public function crear($datos)
    {
        $id = DB::table('modulos')->insertGetId($datos);

        return DB::table('modulos')->find($id);
    }

    public function actualizar($id, $datos)
    {
        $modulo = DB::table('modulos')->find($id);

        if (!$modulo) {
            return null;
        }

        DB::table('modulos')->where('id', $id)->update($datos);

        return DB::table('modulos')->find($id);
    }

    public function eliminar($id)
    {
        $modulo = DB::table('modulos')->find($id);

        if (!$modulo) {
            return null;
        }

        DB::table('modulos')->where('id', $id)->delete();

        return $modulo;
    }
}
