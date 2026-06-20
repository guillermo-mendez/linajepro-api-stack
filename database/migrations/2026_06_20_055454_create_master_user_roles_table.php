<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_user_roles', function (Blueprint $table) {
            $table->id();
            // ID interno de la relación usuario-rol.

            $table->foreignId('master_user_id')
                ->constrained('master_users')
                ->cascadeOnDelete();
            // Usuario al que se le asigna el rol.

            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnDelete();
            // Rol asignado al usuario.

            $table->timestamps();
            // created_at y updated_at.

            $table->unique(['master_user_id', 'role_id']);
            // Evita asignar el mismo rol dos veces al mismo usuario.

            $table->index('master_user_id');
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_user_roles');
    }
};
