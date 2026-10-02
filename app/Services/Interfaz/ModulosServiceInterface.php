<?php

namespace App\Services\Interfaz;

interface ModulosServiceInterface
{
    public function listar();

    public function obtener($id);

    public function crear($datos);

    public function actualizar($id, $datos);

    public function eliminar($id);
}
