<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {

            $table->id();
            // ID interno del permiso.

            $table->uuid('uuid')->unique();
            // Identificador público del permiso.

            $table->string('module', 100);
            // Módulo al que pertenece.
            //
            // Ejemplos:
            // birds
            // breedings
            // cages
            // health
            // inventory
            // users

            $table->string('code', 100)->unique();
            // Código técnico del permiso.
            //
            // Ejemplos:
            // birds.create
            // birds.update
            // birds.delete
            // users.manage

            $table->string('name', 150);
            // Nombre visible.
            //
            // Ejemplo:
            // Crear aves
            // Editar aves
            // Eliminar aves

            $table->text('description')->nullable();
            // Descripción funcional.

            $table->string('status', 30)->default('active');
            // active
            // inactive

            $table->timestamps();

            $table->softDeletes();

            $table->index('module');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
