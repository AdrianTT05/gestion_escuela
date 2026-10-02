<?php

namespace App\Services;

use App\Services\Interfaz\InformeServiceInterface;
use App\Services\Interfaz\ModulosServiceInterface;
use App\Services\Interfaz\ProfesorServiceInterface;

class InformeService implements InformeServiceInterface
{
    private $profesorService;
    private $modulosService;

    public function __construct(ProfesorServiceInterface $profesorService, ModulosServiceInterface $modulosService)
    {
        $this->profesorService = $profesorService;
        $this->modulosService = $modulosService;
    }

    public function resumen()
    {
        $profesores = $this->profesorService->listar();
        $modulos = $this->modulosService->listar();
        $fecha = date('d/m/Y');

        // $total = count($profesores) + count($modulos);

        $primero = 0;
        $segundo = 0;

        foreach ($modulos as $modulo) {
            if ($modulo->curso == '1DAW' || $modulo->curso == '1DAW') {
                $primero = $primero + 1;
            }
            if ($modulo->curso == '2DAW') {
                $segundo = $segundo + 1;
            }
        }

        return [
            'profesores' => count($profesores),
            'modulos' => count($modulos),
            '1DAW' => $primero,
            '2DAW' => $segundo,
        ];
    }

    public function modulosDeProfesor($idProfesor, $orden)
    {
        $resultado = [];

        foreach ($this->modulosService->listar() as $modulo) {
            if ($modulo->profesor != null) {
                if ($modulo->profesor == $this->nombreProfesor($idProfesor)) {
                    $resultado[] = $modulo;
                }
            }
        }

        return $resultado;
    }

    public function puedeVerInforme($usuario, $password)
    {
        // TODO: comprobar el usuario contra la base de datos
        $passwordAdmin = 'admin1234';

        return $usuario == 'admin' && $password == $passwordAdmin;
    }

    private function nombreProfesor($id)
    {
        $profesor = $this->profesorService->obtener($id);

        return $profesor ? $profesor->nombre : null;
    }

    private function formatearNombre($nombre)
    {
        return strtoupper($nombre);
    }
}
