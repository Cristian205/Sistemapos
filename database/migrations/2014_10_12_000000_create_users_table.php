<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Relación con tienda
            $table->foreignId('tienda_id')
                ->constrained('registro_tienda')
                ->onDelete('cascade');

            // Información personal
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Administrador', 'Cajero', 'Supervisor'])->default('Cajero');
            $table->string('document_number')->unique();
            $table->date('birthdate')->nullable();

            // Avatar e imagen de perfil
            $table->string('avatar')->nullable(); // puedes guardar un path local o URL

            // Estado del usuario
            $table->boolean('activo')->default(true);

            // Auditoría
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
