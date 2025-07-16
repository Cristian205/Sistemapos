<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaNegocio extends Model
{
    use HasFactory;

    public $table = 'categoria_negocios';

    public $fillable = ['id', 'nombre', 'descripcion'];
}
