<?php

namespace Tests\Feature;

use App\Repositories\Db\ModulosDbRepository;
use App\Repositories\Interfaz\ModulosRepositoryInterface;

class ModulosDbTest extends ModulosTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->bind(ModulosRepositoryInterface::class, ModulosDbRepository::class);
    }
}
