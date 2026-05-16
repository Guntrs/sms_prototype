<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * LISTAR CLIENTES
     */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    /**
     * CREAR CLIENTE
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'telefono'  => $request->telefono,
            'dpi'       => $request->dpi,
            'direccion' => $request->direccion,
            'activo'    => true
        ]);

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => $cliente
        ], 201);
    }

    /**
     * MOSTRAR UN CLIENTE
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        return response()->json($cliente);
    }

    /**
     * ACTUALIZAR CLIENTE
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        $cliente->update([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'telefono'  => $request->telefono,
            'dpi'       => $request->dpi,
            'direccion' => $request->direccion,
            'activo'    => $request->activo
        ]);

        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'data' => $cliente
        ]);
    }

    /**
     * ELIMINAR CLIENTE
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado'
            ], 404);
        }

        $cliente->delete();

        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ]);
    }
}
