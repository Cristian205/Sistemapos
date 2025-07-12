<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->decimal('precio', 10, 2)->default(0)->comment('Precio en pesos colombianos');
            $table->integer('duracion_dias')->default(30)->comment('Duración del plan en días');
            $table->text('descripcion')->nullable();

            // Límites y capacidades
            $table->integer('usuarios_maximos')->default(1);
            $table->integer('sucursales_maximas')->default(1);
            $table->integer('productos_maximos')->nullable();

            // Características del plan
            $table->boolean('facturacion_electronica')->default(false);
            $table->boolean('soporte_prioritario')->default(false);
            $table->boolean('respaldo_automatico')->default(false);
            $table->boolean('acceso_api')->default(false);

            // Estado del plan
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
};
