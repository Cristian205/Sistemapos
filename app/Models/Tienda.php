<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'registro_tienda';

    protected $fillable = [
        'Nombre_tienda',
        'Telefono_corporativo',
        'Correo_corporativo',
        'Direccion_corporativa',
        'NIT',
        'Logo_tienda',
        'Descripcion_corporativa',
        'plan_id',
        'Fecha_Inicio',
        'Fecha_Final',
        'activa',
        'ip_registro',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
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
