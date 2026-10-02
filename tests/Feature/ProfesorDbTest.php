<?php

namespace Tests\Feature;

use App\Repositories\Db\ProfesorDbRepository;
use App\Repositories\Interfaz\ProfesorRepositoryInterface;

// Repite TODOS los tests de ProfesorTest, pero usando el repositorio Db
class ProfesorDbTest extends ProfesorTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(ProfesorRepositoryInterface::class, ProfesorDbRepository::class);
    }
}
