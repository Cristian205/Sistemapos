<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = '_planes';

    protected $fillable = [
        'nombre',
        'precio',
        'duracion_dias',
        'descripcion',
        'usuarios_maximos',
        'sucursales_maximas',
        'productos_maximos',
        'facturacion_electronica',
        'soporte_prioritario',
        'respaldo_automatico',
        'acceso_api',
        'activo',
    ];

    public function tiendas()
    {
        return $this->hasMany(Tienda::class, 'plan_id');
    }

    public function subscripciones()
    {
        return $this->hasMany(Subscripcion::class, 'plan_id');
    }
}
