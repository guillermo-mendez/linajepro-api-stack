<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            // ID interno autoincremental de MariaDB.

            $table->uuid('uuid')->unique();
            // Identificador público del tenant/gallera.

            $table->foreignId('database_connection_profile_id')
                ->constrained('database_connection_profiles')
                ->restrictOnDelete();
            // Perfil de conexión donde vive la base de datos del tenant.
            // Permite mover tenants entre servidores.

            $table->string('tenant_code', 6)->unique();
            // Código automático de 6 dígitos para login y QR.

            $table->string('name', 150);
            // Nombre de la gallera o criadero.

            $table->string('phone', 30)->nullable();
            // Teléfono de contacto.

            $table->string('status', 30)->default('active');
            // Estado: active, suspended, cancelled.

            $table->string('db_name', 150)->unique();
            // Nombre de la base de datos exclusiva del tenant.
            // Ejemplo: linajepro_482751.

            $table->timestamp('last_sync_at')->nullable();
            // Última sincronización offline registrada.

            $table->timestamps();
            // created_at y updated_at.

            $table->softDeletes();
            // Eliminación lógica.

            $table->index('status');
            $table->index('last_sync_at');
            $table->index('database_connection_profile_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
