<?php

namespace App\Services;

use App\Repositories\Interfaz\ProfesorRepositoryInterface;
use App\Services\Interfaz\ProfesorServiceInterface;

class ProfesorService implements ProfesorServiceInterface
{
    private $profesorRepository;

    public function __construct(ProfesorRepositoryInterface $profesorRepository)
    {
        $this->profesorRepository = $profesorRepository;
    }

    public function listar()
    {
        return $this->profesorRepository->todos();
    }

    public function obtener($id)
    {
        return $this->profesorRepository->buscarPorId($id);
    }

    public function crear($datos)
    {
        // Regla de negocio: el email se guarda siempre en minúsculas
        $datos['email'] = strtolower($datos['email']);

        // Regla de negocio: el email no puede estar repetido
        if ($this->profesorRepository->buscarPorEmail($datos['email'])) {
            return null;
        }

        return $this->profesorRepository->crear($datos);
    }

    public function actualizar($id, $datos)
    {
        $datos['email'] = strtolower($datos['email']);

        // Regla de negocio: el email no puede estar repetido, salvo si pertenece al mismo profesor
        $profesorExistente = $this->profesorRepository->buscarPorEmail($datos['email']);
        if ($profesorExistente && $profesorExistente->id != $id) {
            return "ya existe un profesor con ese email";
        }

        return $this->profesorRepository->actualizar($id, $datos);
    }

    public function eliminar($id)
    {
        return $this->profesorRepository->eliminar($id);
    }
}
