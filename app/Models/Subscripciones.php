<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscripcion extends Model
{
    use HasFactory;

    protected $table = 'subscripciones';

    protected $fillable = [
        'tienda_id',
        'plan_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'monto_pagado',
        'forma_pago',
        'ip_registro',
    ];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
