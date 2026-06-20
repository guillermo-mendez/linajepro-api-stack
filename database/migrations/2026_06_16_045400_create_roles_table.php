<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {

            $table->id();
            // ID interno del rol.

            $table->uuid('uuid')->unique();
            // Identificador público del rol.
            // Se utilizará en API y auditoría.

            $table->string('code', 50)->unique();
            // Código técnico del rol.
            //
            // Ejemplos:
            // super_admin
            // tenant_admin
            // operator
            // viewer

            $table->string('name', 100);
            // Nombre visible del rol.
            //
            // Ejemplos:
            // Super Administrador
            // Administrador
            // Operario
            // Consulta

            $table->text('description')->nullable();
            // Descripción funcional del rol.

            $table->string('status', 30)->default('active');
            // Estado del rol.
            //
            // active
            // inactive

            $table->timestamps();
            // created_at
            // updated_at

            $table->softDeletes();
            // deleted_at

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
