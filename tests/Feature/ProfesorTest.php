<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesorTest extends TestCase
{
    use RefreshDatabase;

    // Antes de cada test, rellena la base de datos con los seeders
    protected $seed = true;

    public function test_el_listado_muestra_los_tres_profesores(): void
    {
        $respuesta = $this->get('/profesores');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('Ana Martínez');
        $respuesta->assertSee('Carlos López');
        $respuesta->assertSee('Leonardo García');
    }

    public function test_el_detalle_muestra_el_profesor_pedido(): void
    {
        $respuesta = $this->get('/profesores/2');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('Carlos López');
    }

    public function test_el_detalle_de_un_profesor_que_no_existe_da_404(): void
    {
        $respuesta = $this->get('/profesores/9');

        $respuesta->assertStatus(404);
    }

    public function test_el_formulario_de_crear_se_muestra(): void
    {
        $respuesta = $this->get('/profesores/create');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('Añadir Profesor');
    }

    public function test_crear_guarda_el_email_en_minusculas(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => 'Pepe Pérez',
            'email' => 'PEPE@EDUCA.JCCM.ES',
        ]);

        $respuesta->assertRedirect('/profesores/created');
        $this->assertDatabaseHas('profesores', [
            'nombre' => 'Pepe Pérez',
            'email' => 'pepe@educa.jccm.es',
        ]);
    }

    public function test_crear_con_un_email_repetido_da_409(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => 'Otra Ana',
            'email' => 'AMartinez@educa.jccm.es',
        ]);

        $respuesta->assertStatus(409);
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_crear_sin_nombre_no_pasa_la_validacion(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => '',
            'email' => 'pepe@educa.jccm.es',
        ]);

        $respuesta->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_el_formulario_de_editar_sale_relleno(): void
    {
        $respuesta = $this->get('/profesores/2/edit');

        $respuesta->assertStatus(200);
        $respuesta->assertSee('clopez@educa.jccm.es');
    }

    public function test_editar_un_profesor_que_no_existe_da_404(): void
    {
        $respuesta = $this->get('/profesores/9/edit');

        $respuesta->assertStatus(404);
    }

    public function test_actualizar_guarda_el_email_en_minusculas(): void
    {
        $respuesta = $this->put('/profesores/2', [
            'nombre' => 'Carlos López',
            'email' => 'CLopez.Nuevo@educa.jccm.es',
        ]);

        $respuesta->assertRedirect('/profesores/updated');
        $this->assertDatabaseHas('profesores', [
            'id' => 2,
            'email' => 'clopez.nuevo@educa.jccm.es',
        ]);
    }

    public function test_actualizar_solo_el_nombre_manteniendo_su_email(): void
    {
        $respuesta = $this->put('/profesores/2', [
            'nombre' => 'Carlos López Ruiz',
            'email' => 'clopez@educa.jccm.es',
        ]);

        $respuesta->assertRedirect('/profesores/updated');
        $this->assertDatabaseHas('profesores', ['id' => 2, 'nombre' => 'Carlos López Ruiz']);
    }

    public function test_actualizar_con_el_email_de_otro_profesor_da_409(): void
    {
        $respuesta = $this->put('/profesores/2', [
            'nombre' => 'Carlos López',
            'email' => 'amartinez@educa.jccm.es',
        ]);

        $respuesta->assertStatus(409);
        $this->assertDatabaseHas('profesores', ['id' => 2, 'email' => 'clopez@educa.jccm.es']);
    }

    public function test_actualizar_un_profesor_que_no_existe_da_404(): void
    {
        $respuesta = $this->put('/profesores/9', [
            'nombre' => 'Nadie',
            'email' => 'nadie@educa.jccm.es',
        ]);

        $respuesta->assertStatus(404);
    }

    public function test_borrar_elimina_el_profesor(): void
    {
        $respuesta = $this->delete('/profesores/3');

        $respuesta->assertRedirect('/profesores/deleted');
        $this->assertDatabaseMissing('profesores', ['id' => 3]);
    }

    public function test_borrar_un_profesor_que_no_existe_da_404(): void
    {
        $respuesta = $this->delete('/profesores/9');

        $respuesta->assertStatus(404);
    }

    public function test_un_profesor_creado_aparece_en_el_listado(): void
    {
        $this->post('/profesores', [
            'nombre' => 'Pepe Pérez',
            'email' => 'pepe@educa.jccm.es',
        ]);

        $respuesta = $this->get('/profesores');

        $respuesta->assertSee('Pepe Pérez');
        $this->assertDatabaseCount('profesores', 4);
    }

    public function test_crear_sin_email_no_pasa_la_validacion(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => 'Pepe Pérez',
            'email' => '',
        ]);

        $respuesta->assertSessionHasErrors('email');
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_crear_con_un_email_mal_escrito_no_pasa_la_validacion(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => 'Pepe Pérez',
            'email' => 'pepe.educa.jccm.es',
        ]);

        $respuesta->assertSessionHasErrors('email');
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_crear_con_un_nombre_demasiado_largo_no_pasa_la_validacion(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => str_repeat('a', 101),
            'email' => 'pepe@educa.jccm.es',
        ]);

        $respuesta->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_crear_con_un_email_repetido_en_mayusculas_da_409(): void
    {
        $respuesta = $this->post('/profesores', [
            'nombre' => 'Otro Carlos',
            'email' => 'CLOPEZ@EDUCA.JCCM.ES',
        ]);

        $respuesta->assertStatus(409);
        $this->assertDatabaseCount('profesores', 3);
    }

    public function test_actualizar_sin_nombre_no_pasa_la_validacion(): void
    {
        $respuesta = $this->put('/profesores/2', [
            'nombre' => '',
            'email' => 'clopez@educa.jccm.es',
        ]);

        $respuesta->assertSessionHasErrors('nombre');
        $this->assertDatabaseHas('profesores', ['id' => 2, 'nombre' => 'Carlos López']);
    }
}
