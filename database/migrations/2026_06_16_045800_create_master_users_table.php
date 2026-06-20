<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->id();
            // ID interno autoincremental de MariaDB. No se expone en la API.

            $table->uuid('uuid')->unique();
            // Identificador público del usuario para API, JWT, auditoría y PWA.

            $table->foreignId('tenant_id')
                ->constrained('tenants')
                ->cascadeOnDelete();
            // Gallera/criadero al que pertenece el usuario.

            $table->string('name', 150);
            // Nombre real del usuario.

            $table->string('username', 50);
            // Usuario corto para login. Ejemplo: ADMIN, PEDRO.

            $table->string('pin_hash');
            // PIN cifrado con Hash::make(). Nunca guardar PIN plano.

            $table->string('status', 30)->default('active');
            // Estado del usuario: active, blocked, inactive.

            $table->timestamp('last_login_at')->nullable();
            // Fecha y hora del último inicio de sesión.

            $table->timestamp('pin_changed_at')->nullable();
            // Fecha del último cambio de PIN.

            $table->timestamps();
            // created_at y updated_at.

            $table->softDeletes();
            // Eliminación lógica.

            $table->unique(['tenant_id', 'username']);
            // Evita username duplicado dentro de la misma gallera.

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_users');
    }
};
