<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permisos')->get();
        $permisos = Permiso::get();
        
        return response()->json(["roles" => $roles, "permisos" => $permisos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function actualizarPermisos($id, Request $request){
        $role = Role::find($id);

 

        $role->permisos()->sync([]);

        foreach ($request["permisos"] as $permiso) {
          
            $role->permisos()->attach($permiso['id']);
        }

        return response()->json(["mensaje" => "Permisos Actualizados"]);
        
    }
}
