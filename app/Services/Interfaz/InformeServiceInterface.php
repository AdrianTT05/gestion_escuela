<?php

namespace App\Services\Interfaz;

interface InformeServiceInterface
{
    public function resumen();

    public function modulosDeProfesor($idProfesor, $orden);

    public function puedeVerInforme($usuario, $password);
}
