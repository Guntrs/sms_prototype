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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            // Datos básicos
            $table->string('nombre');
            $table->string('apellido');

            // Datos únicos
            $table->string('email')->unique();
            $table->string('telefono')->nullable();

            // Documento
            $table->string('dpi')->unique();

            // Dirección
            $table->string('direccion')->nullable();

            // Estado lógico
            $table->boolean('activo')->default(true);

            // Laravel timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
