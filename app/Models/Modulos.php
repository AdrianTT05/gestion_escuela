<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    // La tabla de la base de datos (si no, Laravel buscaría "profesors")
    protected $table = 'modulos';

    // La tabla no tiene las columnas created_at y updated_at
    public $timestamps = false;

    // Los campos que se pueden rellenar con create() y update()
    protected $fillable = ['codigo', 'nombre', 'descripcion', 'curso','profesor'];
}
