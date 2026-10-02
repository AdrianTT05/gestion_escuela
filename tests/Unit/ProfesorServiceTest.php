<?php

namespace Tests\Unit;

use App\Repositories\Interfaz\ProfesorRepositoryInterface;
use App\Services\ProfesorService;
use PHPUnit\Framework\TestCase;

class ProfesorServiceTest extends TestCase
{
    public function test_crear_pasa_el_email_a_minusculas(): void
    {
        // Preparar: un repositorio falso
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        $repositorio->method('buscarPorEmail')->willReturn(null);
        $repositorio->expects($this->once())
            ->method('crear')
            ->with(['nombre' => 'Pepe', 'email' => 'pepe@educa.jccm.es'])
            ->willReturn((object) ['id' => 4, 'nombre' => 'Pepe', 'email' => 'pepe@educa.jccm.es']);

        $servicio = new ProfesorService($repositorio);

        // Actuar
        $resultado = $servicio->crear(['nombre' => 'Pepe', 'email' => 'PEPE@EDUCA.JCCM.ES']);

        // Comprobar
        $this->assertSame('pepe@educa.jccm.es', $resultado->email);
    }

    public function test_crear_busca_el_email_ya_en_minusculas(): void
    {
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        $repositorio->expects($this->once())
            ->method('buscarPorEmail')
            ->with('amartinez@educa.jccm.es')
            ->willReturn((object) ['id' => 1]);

        $servicio = new ProfesorService($repositorio);

        $this->assertNull($servicio->crear(['nombre' => 'Ana', 'email' => 'AMartinez@educa.jccm.es']));
    }

    public function test_crear_no_llama_al_repositorio_si_el_email_existe(): void
    {
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        $repositorio->method('buscarPorEmail')->willReturn((object) ['id' => 1]);
        $repositorio->expects($this->never())->method('crear');

        $servicio = new ProfesorService($repositorio);
        $resultado = $servicio->crear(['nombre' => 'Ana', 'email' => 'amartinez@educa.jccm.es']);

        $this->assertNull($resultado);
    }

    public function test_actualizar_pasa_el_email_a_minusculas(): void
    {
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        $repositorio->method('buscarPorEmail')->willReturn(null);
        $repositorio->expects($this->once())
            ->method('actualizar')
            ->with(2, ['nombre' => 'Carlos', 'email' => 'carlos@educa.jccm.es'])
            ->willReturn((object) ['id' => 2]);

        $servicio = new ProfesorService($repositorio);
        $servicio->actualizar(2, ['nombre' => 'Carlos', 'email' => 'CARLOS@educa.jccm.es']);
    }

    public function test_actualizar_con_el_email_de_otro_profesor_da_error(): void
    {
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        $repositorio->method('buscarPorEmail')->willReturn((object) ['id' => 1]);
        $repositorio->expects($this->never())->method('actualizar');

        $servicio = new ProfesorService($repositorio);
        $resultado = $servicio->actualizar('2', ['nombre' => 'Carlos', 'email' => 'amartinez@educa.jccm.es']);

        $this->assertSame('ya existe un profesor con ese email', $resultado);
    }

    public function test_actualizar_con_su_propio_email_si_actualiza(): void
    {
        $repositorio = $this->createMock(ProfesorRepositoryInterface::class);
        // El email lo tiene el profesor 2... que es el mismo que estamos editando
        $repositorio->method('buscarPorEmail')->willReturn((object) ['id' => 2]);
        $repositorio->expects($this->once())
            ->method('actualizar')
            ->willReturn((object) ['id' => 2]);

        $servicio = new ProfesorService($repositorio);
        // El id llega de la URL como texto: '2'
        $resultado = $servicio->actualizar('2', ['nombre' => 'Carlos', 'email' => 'clopez@educa.jccm.es']);

        $this->assertEquals(2, $resultado->id);
    }

    public function test_listar_devuelve_lo_del_repositorio(): void
    {
        $profesor = (object) ['id' => 1, 'nombre' => 'Ana Martínez'];

        $repositorio = $this->createStub(ProfesorRepositoryInterface::class);
        $repositorio->method('todos')->willReturn([$profesor]);

        $servicio = new ProfesorService($repositorio);

        $this->assertSame([$profesor], $servicio->listar());
    }

    public function test_obtener_devuelve_lo_del_repositorio(): void
    {
        $profesor = (object) ['id' => 2, 'nombre' => 'Carlos López'];

        $repositorio = $this->createStub(ProfesorRepositoryInterface::class);
        $repositorio->method('buscarPorId')->willReturn($profesor);

        $servicio = new ProfesorService($repositorio);

        $this->assertSame($profesor, $servicio->obtener(2));
    }

    public function test_eliminar_devuelve_lo_del_repositorio(): void
    {
        $profesor = (object) ['id' => 3, 'nombre' => 'Leonardo García'];

        $repositorio = $this->createStub(ProfesorRepositoryInterface::class);
        $repositorio->method('eliminar')->willReturn($profesor);

        $servicio = new ProfesorService($repositorio);

        $this->assertSame($profesor, $servicio->eliminar(3));
    }
}
