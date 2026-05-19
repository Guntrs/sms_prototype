<?php

// Importa la clase Request.
// Request representa la petición HTTP que viene desde Postman o frontend.
// Aquí vienen los datos enviados por el usuario.
use Illuminate\Http\Request;

// Importa la clase Route.
// Route permite crear las rutas/endpoints de la API.
use Illuminate\Support\Facades\Route;

// Importa el controlador de clientes.
// Aquí está la lógica CRUD de clientes.
use App\Http\Controllers\ClienteController;

// Importa el controlador de autenticación.
// Aquí está login y logout.
use App\Http\Controllers\AuthController;



// ======================================================
// RUTA PARA OBTENER EL USUARIO AUTENTICADO
// ======================================================

// Route::get = ruta tipo GET
// '/user' = endpoint
//
// Cuando alguien haga:
// GET http://localhost:8000/api/user
//
// Laravel ejecutará esta función.
Route::get('/user', function (Request $request) {

    // Devuelve el usuario autenticado actual.
    // Esto funciona porque Sanctum identifica al usuario mediante el token.
    return $request->user();


// middleware('auth:sanctum')
// Antes de entrar a la ruta:
// Laravel verifica si el usuario tiene token válido.
//
// Si NO tiene token:
// devuelve error 401 Unauthorized
//
// Si SÍ tiene token:
// deja pasar.
})->middleware('auth:sanctum');



// ======================================================
// LOGIN
// ======================================================

// Route::post = ruta POST
//
// Cuando Postman haga:
// POST /api/login
//
// Laravel irá a:
// AuthController -> método login()
//
// [AuthController::class, 'login']
// significa:
// "ejecuta la función login del controlador AuthController"
Route::post('/login', [AuthController::class, 'login']);



// ======================================================
// LOGOUT
// ======================================================

// Cuando Postman haga:
// POST /api/logout
//
// Laravel ejecuta:
// AuthController -> logout()
Route::post('/logout', [AuthController::class, 'logout'])

    // Solo usuarios autenticados pueden cerrar sesión.
    ->middleware('auth:sanctum');



// ======================================================
// GRUPO DE RUTAS PROTEGIDAS
// ======================================================

// Todas las rutas dentro del group()
// requieren autenticación con Sanctum.
Route::middleware('auth:sanctum')->group(function () {



    // ==================================================
    // OBTENER TODOS LOS CLIENTES
    // ==================================================

    // GET /api/clientes
    //
    // Laravel ejecuta:
    // ClienteController -> index()
    //
    // Normalmente index():
    // - consulta todos los clientes
    // - devuelve JSON
    Route::get('/clientes', [ClienteController::class, 'index']);



    // ==================================================
    // CREAR CLIENTE
    // ==================================================

    // POST /api/clientes
    //
    // Laravel ejecuta:
    // ClienteController -> store()
    //
    // store():
    // - recibe datos
    // - valida
    // - guarda en MySQL
    Route::post('/clientes', [ClienteController::class, 'store']);



    // ==================================================
    // OBTENER UN CLIENTE POR ID
    // ==================================================

    // GET /api/clientes/1
    //
    // {id} significa parámetro dinámico.
    //
    // Ejemplo:
    // /clientes/5
    //
    // id = 5
    //
    // Laravel ejecuta:
    // ClienteController -> show($id)
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);



    // ==================================================
    // ACTUALIZAR CLIENTE
    // ==================================================

    // PUT /api/clientes/1
    //
    // Laravel ejecuta:
    // ClienteController -> update($id)
    //
    // update():
    // - busca cliente
    // - modifica datos
    // - actualiza MySQL
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);




    // ELIMINAR CLIENTE
    // DELETE /api/clientes/1
    // Laravel ejecuta:
    // ClienteController -> destroy($id)
    // destroy():
    // - busca cliente
    // - elimina registro
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

});
