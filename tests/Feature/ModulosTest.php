<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModulosTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private function datos(array $cambios = []): array
    {
        return array_merge([
            'codigo' => 'prog',
            'nombre' => 'Programación',
            'curso' => '1daw',
            'profesor' => 2,
        ], $cambios);
    }

    public function test_el_listado_muestra_los_modulos_con_el_nombre_del_profesor(): void
    {
        $respuesta = $this->get('/modulos');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('DWES');
        $respuesta->assertSee('Ana Martínez');
        $respuesta->assertSee('Leonardo García');
    }

    public function test_el_formulario_de_crear_se_muestra(): void
    {
        $this->get('/modulos/create')->assertStatus(200);
    }

    public function test_crear_pasa_codigo_y_curso_a_mayusculas(): void
    {
        $respuesta = $this->post('/modulos', $this->datos());

        $respuesta->assertRedirect('/modulos/created');
        $this->assertDatabaseHas('modulos', ['codigo' => 'PROG', 'curso' => '1DAW']);
    }

    public function test_crear_con_codigo_repetido_da_409(): void
    {
        $this->post('/modulos', $this->datos(['codigo' => 'dwes']))->assertStatus(409);
        $this->assertDatabaseCount('modulos', 4);
    }

    public function test_crear_con_un_profesor_que_no_existe_da_422(): void
    {
        $this->post('/modulos', $this->datos(['profesor' => 9]))->assertStatus(422);
        $this->assertDatabaseCount('modulos', 4);
    }

    public function test_el_formulario_de_editar_sale_relleno(): void
    {
        $respuesta = $this->get('/modulos/3/edit');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('Diseño de Interfaces Web');
    }

    public function test_editar_un_modulo_que_no_existe_da_404(): void
    {
        $this->get('/modulos/9/edit')->assertStatus(404);
    }

    public function test_actualizar_pasa_el_codigo_a_mayusculas(): void
    {
        $respuesta = $this->put('/modulos/4', $this->datos(['codigo' => 'bd', 'nombre' => 'Bases de Datos', 'profesor' => 1]));

        $respuesta->assertRedirect('/modulos/updated');
        $this->assertDatabaseHas('modulos', ['id' => 4, 'codigo' => 'BD']);
    }

    public function test_actualizar_un_modulo_que_no_existe_da_404(): void
    {
        $this->put('/modulos/9', $this->datos())->assertStatus(404);
    }

    public function test_borrar_elimina_el_modulo(): void
    {
        $this->delete('/modulos/3')->assertRedirect('/modulos/deleted');
        $this->assertDatabaseMissing('modulos', ['id' => 3]);
    }

    public function test_borrar_un_modulo_que_no_existe_da_404(): void
    {
        $this->delete('/modulos/9')->assertStatus(404);
    }
}
