<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('database_connection_profiles', function (Blueprint $table) {
            $table->id();
            // ID interno autoincremental de MariaDB.

            $table->uuid('uuid')->unique();
            // Identificador público del perfil de conexión.

            $table->string('name', 100);
            // Nombre descriptivo del servidor.
            // Ejemplo: Servidor Principal, Servidor Costa, Servidor Premium.

            $table->string('host', 150);
            // Host o IP del servidor MariaDB.
            // Ejemplo: 127.0.0.1, db1.linajepro.com.

            $table->unsignedInteger('port')->default(3306);
            // Puerto de conexión MariaDB.

            $table->string('username', 150);
            // Usuario de conexión al servidor MariaDB.

            $table->text('encrypted_password');
            // Contraseña cifrada del servidor.
            // Debe guardarse usando Crypt::encryptString().

            $table->boolean('use_tls')->default(false);
            // Indica si la conexión al servidor MariaDB utiliza TLS/SSL.

            $table->string('status', 30)->default('active');
            // Estado del perfil: active, inactive, maintenance.

            $table->text('description')->nullable();
            // Notas internas sobre este servidor.

            $table->timestamps();
            // created_at y updated_at.

            $table->softDeletes();
            // Eliminación lógica.

            $table->index('status');
            // Optimiza búsquedas por estado.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('database_connection_profiles');
    }
};
