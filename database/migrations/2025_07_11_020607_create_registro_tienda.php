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
        Schema::create('registro_tienda', function (Blueprint $table) {
            $table->id();

            // Información básica
            $table->string('nombre')->comment('Nombre comercial de la tienda');
            $table->string('telefono')->nullable()->comment('Teléfono corporativo');
            $table->string('email')->nullable()->comment('Correo corporativo');
            $table->string('direccion')->nullable()->comment('Dirección principal');
            $table->string('nit')->unique()->comment('Número de identificación tributaria');

            // Imagen/logo
            $table->string('logo')->nullable()->comment('Ruta o nombre del archivo del logo');
            $table->text('descripcion')->nullable()->comment('Descripción breve de la tienda');

            // Plan y control de pagos
            $table->foreignId('plan_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->comment('Plan activo asociado a la tienda');
            $table->date('fecha_inicio')->nullable()->comment('Inicio del plan activo');
            $table->date('fecha_final')->nullable()->comment('Fin del plan activo');
            $table->boolean('activa')->default(true)->comment('Estado de actividad de la tienda');

            // Auditoría
            $table->ipAddress('ip_registro')->nullable()->comment('IP desde donde se registró la tienda');
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
        Schema::dropIfExists('registro_tienda');
    }
};
