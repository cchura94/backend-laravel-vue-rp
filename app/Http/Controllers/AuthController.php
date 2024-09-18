<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function funIngresar(Request $request){
        $credenciales = $request->validate([
            "email" => "required|email",
            "password"=> "required"
        ]);

        if(!Auth::attempt($credenciales)){
            return response()->json(["mensaje" => "Credenciales Incorrectas"], 401);
        }

        // generar Token (sanctum)
        $usuario = $request->user();
        $token = $usuario->createToken('Token auth')->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "usuario" => $usuario
        ], 201);
       

    }

    public function funRegistro(Request $request){
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|same:c_password",
        ]);
        // registrar

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // responder
        return response()->json(["mensaje" => "Usuario Registrado"]);
    }

    public function funPerfil(Request $request){
        $usuario = $request->user();

        return response()->json($usuario, 200);
    }

    public function funSalir(Request $request){
        $usuario = $request->user();
        $usuario->tokens()->delete();
        
        return response(["mensaje" => "Logout"], 200);
    }
}
