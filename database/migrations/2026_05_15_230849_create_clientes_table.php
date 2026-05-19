<?php

// IMPORTACIONES: Traemos las clases del núcleo de Laravel para estructurar la base de datos.
use Illuminate\Database\Migrations\Migration; // Clase base para crear archivos de migración.
use Illuminate\Database\Schema\Blueprint;    // Clase que define los tipos de datos de las columnas (string, integer, etc.).
use Illuminate\Support\Facades\Schema;       // Fachada que ejecuta la creación o eliminación de las tablas.

// Retorna una clase anónima que hereda las propiedades de una migración de Laravel.
return new class extends Migration
{
    /**
     * MÉTODO UP: Se ejecuta cuando corres el comando `php artisan migrate`.
     * Su función es CREAR la tabla y definir sus columnas en la base de datos.
     */
    public function up(): void
    {
        // Schema::create manda la orden a la base de datos de fabricar la tabla llamada 'clientes'.
        Schema::create('clientes', function (Blueprint $table) {

            // Crea una columna 'id' que es de tipo BIGINT, llave primaria y se autoincrementa (1, 2, 3...).
            $table->id();

            // --- DATOS BÁSICOS ---
            // Crea una columna de tipo VARCHAR para almacenar texto corto. Es obligatoria (no acepta nulos).
            $table->string('nombre');

            // Crea otra columna VARCHAR obligatoria para almacenar el apellido.
            $table->string('apellido');

            // --- DATOS ÚNICOS ---
            // Crea una columna VARCHAR para el correo.
            // 'unique()' le dice a la base de datos que NO puede haber dos correos idénticos en la tabla.
            $table->string('email')->unique();

            // Crea una columna VARCHAR para el teléfono.
            // 'nullable()' significa que es opcional. Si el cliente no da su teléfono, en la BD se guarda como NULL.
            $table->string('telefono')->nullable();

            // --- DOCUMENTO ---
            // Crea una columna VARCHAR para el DPI.
            // Al ponerle 'unique()', aseguras a nivel de base de datos que cada cliente tenga un documento irrepetible.
            $table->string('dpi')->unique();

            // --- DIRECCIÓN ---
            // Crea una columna VARCHAR para la dirección que también es opcional (puede quedar vacía o NULL).
            $table->string('direccion')->nullable();

            // --- ESTADO LÓGICO ---
            // Crea una columna booleana (guarda 1 para verdadero y 0 para falso).
            // 'default(true)' hace que si al crear el cliente no especificas este campo, se guardará automáticamente como activo (true).
            $table->boolean('activo')->default(true);

            // --- LARAVEL TIMESTAMPS ---
            // Este comando crea automáticamente dos columnas en tu tabla:
            // 1. 'created_at': Guarda la fecha y hora exacta en que el cliente se registró.
            // 2. 'updated_at': Guarda la fecha y hora exacta de la última vez que modificaste al cliente.
            $table->timestamps();
        });
    }

    /**
     * MÉTODO DOWN: Se ejecuta cuando corres el comando `php artisan migrate:rollback`.
     * Su función es DESHACER lo que hizo el método UP (borrar los cambios).
     */
    public function down(): void
    {
        // Si decides revertir la migración, este comando elimina por completo la tabla 'clientes' y todos sus datos.
        Schema::dropIfExists('clientes');
    }
};
