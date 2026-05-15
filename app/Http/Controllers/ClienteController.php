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
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'dpi'      => $request->dpi,
            'direccion'=> $request->direccion,
            'activo'   => true
        ]);

        return response()->json([
            'message' => 'Cliente creado',
            'data' => $cliente
        ], 201);
    }
}
