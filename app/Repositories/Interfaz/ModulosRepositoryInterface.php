<?php

namespace App\Repositories\Interfaz;

interface ModulosRepositoryInterface
{
    public function todos();

    public function buscarPorId($id);

    public function buscarPorCodigo($codigo);

    public function crear($datos);

    public function actualizar($id, $datos);

    public function eliminar($id);
}
