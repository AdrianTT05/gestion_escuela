<?php

namespace App\Services;

use App\Repositories\Interfaz\ModulosRepositoryInterface;
use App\Services\Interfaz\ModulosServiceInterface;
use App\Services\Interfaz\ProfesorServiceInterface;

class ModulosService implements ModulosServiceInterface
{
    private $modulosRepository;
    private $profesorService;

    public function __construct(ModulosRepositoryInterface $modulosRepository,
        ProfesorServiceInterface $profesorService)
    {
        $this->modulosRepository = $modulosRepository;
        $this->profesorService = $profesorService;
    }

    public function listar()
    {
        $modulos = $this->modulosRepository->todos();

        foreach ($modulos as $modulo) {
            $profesor = $this->profesorService->obtener($modulo->profesor);
            $modulo->profesor = $profesor->nombre;
        }
        return $modulos;
    }

    public function obtener($id)
    {
        $modulo = $this->modulosRepository->buscarPorId($id);

        return $modulo;
    }

    public function crear($datos)
    {
        $datos['codigo'] = strtoupper($datos['codigo']);
        $datos['curso'] = strtoupper($datos['curso']);

    // Regla de negocio: el codigo no puede estar repetido
        if ($this->modulosRepository->buscarPorCodigo($datos['codigo'])) {
        return 'codigo_duplicado';
        }
        if (!$this->profesorService->obtener($datos['profesor'])) {
        return 'profesor_no_encontrado';
        }

        return $this->modulosRepository->crear($datos);
    }

    public function actualizar($id, $datos)
    {
        $datos['codigo'] = strtoupper($datos['codigo']);
        $datos['curso'] = strtoupper($datos['curso']);

        return $this->modulosRepository->actualizar($id, $datos);
    }

    public function eliminar($id)
    {
        return $this->modulosRepository->eliminar($id);
    }
}
