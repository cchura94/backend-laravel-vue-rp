<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/auth')->group(function(){

    Route::post("login", [AuthController::class, "funIngresar"]);
    Route::post("register", [AuthController::class, "funRegistro"]);

    Route::middleware('auth:sanctum')->group(function(){

        Route::get("profile", [AuthController::class, "funPerfil"]);
        Route::post("logout", [AuthController::class, "funSalir"]);

    });

});

Route::middleware('auth:sanctum')->group(function(){

    // actualizar permisos
    Route::put('/roles/{id}/permisos', [RoleController::class, "actualizarPermisos"]);
    Route::post('/usuario/{id}/asignar-roles', [UserController::class, "actualizarRoles"]);

    

    // routas CRUD api Rest
    Route::apiResource("usuario", UserController::class);
    Route::apiResource("roles", RoleController::class);
    Route::apiResource("permiso", PermisoController::class);
    Route::apiResource("persona", PersonaController::class);
    Route::apiResource("unidad", UnidadController::class);
});

Route::get("/no-autorizado", function(){
    return ["mensaje" => "No Autorizado"];
})->name("login");
