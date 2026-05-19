<?php

// Define dónde está guardado este archivo para que Laravel lo localice automáticamente.
namespace App\Http\Controllers;

// IMPORTACIONES DE CLASES: Traemos las herramientas que usaremos abajo.
use App\Models\Cliente;      // Importa el Modelo Cliente para poder hablar con la tabla 'clientes' en la base de datos.
use Illuminate\Http\Request; // Importa la herramienta Request para leer lo que el usuario envía (formularios, JSON, etc.).

// Definición de la clase del controlador que maneja todo el CRUD de Clientes.
class ClienteController extends Controller
{
    /**
     * ACCIÓN 1: LISTAR TODOS LOS CLIENTES (Habitualmente con método GET)
     */
    public function index()
    {
        // Cliente::all() va a la base de datos y hace un "SELECT * FROM clientes".
        // Guarda todos los registros encontrados en la variable $clientes.
        $clientes = Cliente::all();

        // Transforma la lista de clientes a formato JSON y la envía de vuelta con un código 200 (Éxito).
        return response()->json($clientes);
    }

    /**
     * ACCIÓN 2: CREAR Y GUARDAR UN NUEVO CLIENTE (Habitualmente con método POST)
     */
    public function store(Request $request)
    {
        // Cliente::create([...]) inserta una nueva fila en la tabla 'clientes'.
        // Mapea cada columna de la base de datos con los datos que vienen en la petición ($request->...).
        $cliente = Cliente::create([
            'nombre'    => $request->nombre,    // Captura el 'nombre' enviado por el usuario.
            'apellido'  => $request->apellido,  // Captura el 'apellido'.
            'email'     => $request->email,     // Captura el 'email'.
            'telefono'  => $request->telefono,  // Captura el 'telefono'.
            'dpi'       => $request->dpi,       // Captura el 'dpi'.
            'direccion' => $request->direccion, // Captura la 'direccion'.
            'activo'    => true                 // Por defecto, lo guarda como activo (true/1) en la BD.
        ]);

        // Retorna un JSON confirmando el éxito.
        // El número 201 es el código HTTP estándar para decir "Se ha creado un recurso con éxito".
        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => $cliente // Devuelve los datos del cliente recién creado (incluyendo su ID de la BD).
        ], 201);
    }

    /**
     * ACCIÓN 3: MOSTRAR UN SOLO CLIENTE POR SU ID (Habitualmente con método GET y un ID en la URL)
     */
    public function show($id)
    {
        // Cliente::find($id) busca en la tabla al cliente cuyo ID coincida con el de la URL.
        // Equivale a: "SELECT * FROM clientes WHERE id = $id LIMIT 1"
        $cliente = Cliente::find($id);

        // CONTROL DE ERRORES: Si el cliente no existe, la variable $cliente estará vacía (null).
        if (!$cliente) {
            // El signo '!' significa "Si NO existe el cliente..."
            // Retorna un mensaje de error y un código HTTP 404 (No encontrado).
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        // Si el cliente sí existe, se salta el 'if' y devuelve los datos de ese cliente en JSON.
        return response()->json($cliente);
    }

    /**
     * ACCIÓN 4: ACTUALIZAR LOS DATOS DE UN CLIENTE (Habitualmente con método PUT o PATCH)
     */
    public function update(Request $request, $id)
    {
        // Primero busca al cliente en la base de datos por su ID para verificar si existe.
        $cliente = Cliente::find($id);

        // Si el cliente no existe en la base de datos, frena el código aquí y devuelve un error 404.
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        // Si existe, toma el cliente encontrado y usa el método ->update([...])
        // Reemplaza los datos viejos de la base de datos por los datos nuevos que vienen en el $request.
        $cliente->update([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'telefono'  => $request->telefono,
            'dpi'       => $request->dpi,
            'direccion' => $request->direccion,
            'activo'    => $request->activo // Permite cambiar el estado (por ejemplo, pasarlo de true a false).
        ]);

        // Retorna un JSON con el mensaje de éxito y los datos ya actualizados.
        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'data' => $cliente
        ]);
    }

    /**
     * ACCIÓN 5: ELIMINAR UN CLIENTE DE LA BASE DE DATOS (Habitualmente con método DELETE)
     */
    public function destroy($id)
    {
        // Primero busca al cliente en la base de datos por su ID.
        $cliente = Cliente::find($id);

        // Si no existe, detiene la ejecución y devuelve el error 404.
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        // Si existe, ejecuta el método ->delete() el cual hace un "DELETE FROM clientes WHERE id = $id"
        $cliente->delete();

        // Retorna un JSON confirmando que el registro fue borrado físicamente de la base de datos.
        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ]);
    }
}
