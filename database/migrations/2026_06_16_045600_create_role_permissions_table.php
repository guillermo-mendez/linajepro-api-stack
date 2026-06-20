<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {

            $table->id();
            // ID interno de la relación rol-permiso.

            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnDelete();
            // Rol al que se le asigna el permiso.

            $table->foreignId('permission_id')
                ->constrained('permissions')
                ->cascadeOnDelete();
            // Permiso asignado al rol.

            $table->timestamps();
            // created_at y updated_at.

            $table->unique(['role_id', 'permission_id']);
            // Evita asignar dos veces el mismo permiso al mismo rol.

            $table->index('role_id');
            $table->index('permission_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
