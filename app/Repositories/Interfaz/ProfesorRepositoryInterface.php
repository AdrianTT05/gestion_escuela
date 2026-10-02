<?php

namespace App\Repositories\Interfaz;

interface ProfesorRepositoryInterface
{
    public function todos();

    public function buscarPorId($id);

    public function buscarPorEmail($email);

    public function crear($datos);

    public function actualizar($id, $datos);

    public function eliminar($id);
}
