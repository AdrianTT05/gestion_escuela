<?php

namespace Tests\Unit;

use App\Repositories\Interfaz\ModulosRepositoryInterface;
use App\Services\Interfaz\ProfesorServiceInterface;
use App\Services\ModulosService;
use PHPUnit\Framework\TestCase;

class ModulosServiceTest extends TestCase
{
    private function datos(array $cambios = []): array
    {
        return array_merge(['codigo' => 'prog', 'nombre' => 'Programación', 'curso' => '1daw', 'profesor' => 2], $cambios);
    }

    public function test_crear_pasa_codigo_y_curso_a_mayusculas(): void
    {
        $repositorio = $this->createMock(ModulosRepositoryInterface::class);
        $repositorio->method('buscarPorCodigo')->willReturn(null);
        $repositorio->expects($this->once())
            ->method('crear')
            ->with(['codigo' => 'PROG', 'nombre' => 'Programación', 'curso' => '1DAW', 'profesor' => 2])
            ->willReturn((object) ['id' => 5]);

        $profesores = $this->createStub(ProfesorServiceInterface::class);
        $profesores->method('obtener')->willReturn((object) ['id' => 2, 'nombre' => 'Carlos López']);

        $servicio = new ModulosService($repositorio, $profesores);

        $this->assertEquals((object) ['id' => 5], $servicio->crear($this->datos()));
    }

    public function test_crear_detecta_el_codigo_duplicado_aunque_venga_en_minusculas(): void
    {
        $repositorio = $this->createMock(ModulosRepositoryInterface::class);
        $repositorio->expects($this->once())
            ->method('buscarPorCodigo')
            ->with('DWES')
            ->willReturn((object) ['id' => 1]);
        $repositorio->expects($this->never())->method('crear');

        $servicio = new ModulosService($repositorio, $this->createStub(ProfesorServiceInterface::class));

        $this->assertSame('codigo_duplicado', $servicio->crear($this->datos(['codigo' => 'dwes'])));
    }

    public function test_crear_con_profesor_inexistente_devuelve_profesor_no_encontrado(): void
    {
        $repositorio = $this->createMock(ModulosRepositoryInterface::class);
        $repositorio->method('buscarPorCodigo')->willReturn(null);
        $repositorio->expects($this->never())->method('crear');

        $profesores = $this->createStub(ProfesorServiceInterface::class);
        $profesores->method('obtener')->willReturn(null);

        $servicio = new ModulosService($repositorio, $profesores);

        $this->assertSame('profesor_no_encontrado', $servicio->crear($this->datos(['profesor' => 9])));
    }

    public function test_listar_cambia_el_id_del_profesor_por_su_nombre(): void
    {
        $repositorio = $this->createStub(ModulosRepositoryInterface::class);
        $repositorio->method('todos')->willReturn([
            (object) ['id' => 1, 'codigo' => 'DWES', 'profesor' => '1'],
            (object) ['id' => 2, 'codigo' => 'DWEC', 'profesor' => '2'],
        ]);

        $profesores = $this->createStub(ProfesorServiceInterface::class);
        $profesores->method('obtener')->willReturnMap([
            ['1', (object) ['id' => 1, 'nombre' => 'Ana Martínez']],
            ['2', (object) ['id' => 2, 'nombre' => 'Carlos López']],
        ]);

        $servicio = new ModulosService($repositorio, $profesores);
        $modulos = $servicio->listar();

        $this->assertSame('Ana Martínez', $modulos[0]->profesor);
        $this->assertSame('Carlos López', $modulos[1]->profesor);
    }

    public function test_actualizar_pasa_codigo_y_curso_a_mayusculas(): void
    {
        $repositorio = $this->createMock(ModulosRepositoryInterface::class);
        $repositorio->method('buscarPorCodigo')->willReturn((object) ['id' => 4]);
        $repositorio->expects($this->once())
            ->method('actualizar')
            ->with('4', $this->datos(['codigo' => 'BD', 'curso' => '1DAW']))
            ->willReturn((object) ['id' => 4]);

        $profesores = $this->createStub(ProfesorServiceInterface::class);
        $profesores->method('obtener')->willReturn((object) ['id' => 2]);

        $servicio = new ModulosService($repositorio, $profesores);
        $servicio->actualizar('4', $this->datos(['codigo' => 'bd']));
    }

    public function test_obtener_devuelve_lo_del_repositorio(): void
    {
        $modulo = (object) ['id' => 1, 'codigo' => 'DWES'];
        $repositorio = $this->createStub(ModulosRepositoryInterface::class);
        $repositorio->method('buscarPorId')->willReturn($modulo);

        $servicio = new ModulosService($repositorio, $this->createStub(ProfesorServiceInterface::class));

        $this->assertSame($modulo, $servicio->obtener(1));
    }

    public function test_eliminar_devuelve_lo_del_repositorio(): void
    {
        $modulo = (object) ['id' => 3, 'codigo' => 'DIW'];
        $repositorio = $this->createStub(ModulosRepositoryInterface::class);
        $repositorio->method('eliminar')->willReturn($modulo);

        $servicio = new ModulosService($repositorio, $this->createStub(ProfesorServiceInterface::class));

        $this->assertSame($modulo, $servicio->eliminar(3));
    }
}
