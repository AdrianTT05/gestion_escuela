<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    // La tabla de la base de datos (si no, Laravel buscaría "profesors")
    protected $table = 'profesores';

    // La tabla no tiene las columnas created_at y updated_at
    public $timestamps = false;

    // Los campos que se pueden rellenar con create() y update()
    protected $fillable = ['nombre', 'email'];
}
