<?php

// Define la ubicación del archivo dentro de la estructura de carpetas (en este caso, dentro de 'app/Models').
namespace App\Models;

// Importa la clase base 'Model' de Eloquent, que contiene toda la magia para comunicarse con la base de datos.
use Illuminate\Database\Eloquent\Model;

// Al extender de 'Model', esta clase se convierte automáticamente en un "Modelo de Eloquent".
class Cliente extends Model
{
    /**
     * VARIABLE $table
     * * Por defecto, Laravel asume que el nombre de la tabla en la base de datos es el plural del modelo (en inglés).
     * Como nuestro modelo se llama 'Cliente', Laravel buscaría una tabla llamada 'clientes' (coincide por el español).
     * Al definir 'protected $table = 'clientes';', estamos asegurando y obligando al modelo a conectarse
     * específicamente a la tabla llamada 'clientes' en la base de datos.
     */
    protected $table = 'clientes';

    /**
     * VARIABLE $fillable (Asignación masiva / Mass Assignment)
     * * Esta es una medida de seguridad CRUCIAL en Laravel.
     * Aquí dentro del arreglo defines qué columnas de la base de datos TIENEN PERMISO para ser llenadas
     * directamente por el usuario desde un formulario o una petición API (como hiciste en el ClienteController).
     * * Si un usuario malintencionado intenta enviar un campo extra (por ejemplo: 'es_administrador' => true)
     * a través de la petición, Laravel lo ignorará por completo porque no está declarado en esta lista.
     */
    protected $fillable = [
        'nombre',    // Permite guardar o actualizar el nombre.
        'apellido',  // Permite guardar o actualizar el apellido.
        'email',     // Permite guardar o actualizar el correo electrónico.
        'telefono',  // Permite guardar o actualizar el teléfono.
        'dpi',       // Permite guardar o actualizar el DPI (Documento de Identificación).
        'direccion', // Permite guardar o actualizar la dirección.
        'activo'     // Permite cambiar el estado del cliente (true/false).
    ];
}
