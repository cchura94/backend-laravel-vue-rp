<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $unidades= Unidad::get();

         return response()->json($unidades, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "seccion" => "required",
        ]);

        $unidad = new Unidad();
        $unidad->nombre = $request->nombre;
        $unidad->seccion = $request->seccion;
        $unidad->descripcion = $request->descripcion;
        $unidad->save();

        return response()->json(["mensaje" => "unidad registrado"], 200);
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
}
