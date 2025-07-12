<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('tienda_id')->constrained('registro_tienda')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('planes')->onDelete('cascade');

            // Datos de la suscripción
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['activa', 'vencida', 'cancelada'])->default('activa');
            $table->decimal('monto_pagado', 12, 2); // en pesos colombianos
            $table->string('forma_pago')->nullable(); // PSE, Tarjeta, etc.

            // Auditoría
            $table->ipAddress('ip_registro')->nullable();
            $table->timestamps();

            $table->comment('Historial de suscripciones de cada tienda al sistema POS Pro');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suscripciones');
    }
};
