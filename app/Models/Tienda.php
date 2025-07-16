<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'registro_tienda';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
        'nit',
        'logo',
        'descripcion',
        'plan_id',
        'categoria_id',
        'fecha_inicio',
        'fecha_final',
        'activa',
        'ip_registro',
    ];

    public function plan()
{
    return $this->belongsTo(Plan::class);
}

    public function usuarios()
    {
        return $this->hasMany(User::class, 'tienda_id');
    }

    public function subscripciones()
    {
        return $this->hasMany(Subscripcion::class, 'tienda_id');
    }
}
