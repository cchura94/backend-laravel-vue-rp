<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index_user');

        $usuarios = User::with(['persona', 'roles'])->orderBy('id', 'desc')->paginate(20);
        // $usuarios2 = DB::select("Select * from users");

        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_user');

        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response()->json(["mensaje" => "Usuario registrado"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('show_user');

        $user = User::findOrFail($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit_user');

        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email,$id",
            "password" => "required"
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->update();

        return response()->json(["mensaje" => "Usuario modificado"]);
   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete_user');

        $usuario = User::find($id);
        $usuario->delete();

        return response()->json(["mensaje" => "Usuario eliminado"]);

    }

    public function actualizarRoles($id, Request $request){
        $usuario = User::find($id);
        $usuario->roles()->sync($request["roles_id"]);

        return response()->json(["mensaje" => "Roles actualizados"]);

    }
}
