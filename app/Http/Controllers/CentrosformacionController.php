<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centrosformacion;
use App\Models\Regionales;

// Controlador para gestionar centros de formación
class CentrosformacionController extends Controller
{
    // Muestra el listado de centros de formación con sus regionales
    public function index()
    {
        $centros = Centrosformacion::with('regional')->get();
        return view('centrosformacion.index', compact('centros'));
    }

    // Muestra formulario para crear nuevo centro
    public function create()
    {
        $regionales = Regionales::all();
        return view('centrosformacion.create', compact('regionales'));
    }

    // Muestra detalles de un centro específico
    public function show($id)
    {
        $centro = Centrosformacion::with('regional')->findOrFail($id);
        return view('centrosformacion.show', compact('centro'));
    }

    // Valida y crea un nuevo centro de formación
    public function store(Request $request)
    {
        // Valida código, denominación, observaciones y regional
        $request->validate([
            'Codigo' => 'required|numeric',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
            'tblregionales_NIS' => 'required|exists:tbl_regionales,NIS'
        ]);

        // Crea el centro con los datos validados
        Centrosformacion::create([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
            'tblregionales_NIS' => $request->tblregionales_NIS
        ]);

        return response()->json(['success' => true], 200);
    }

    // Muestra formulario para editar un centro
    public function edit($id)
    {
        $dato = Centrosformacion::findOrFail($id);
        $regionales = Regionales::all();
        return view('centrosformacion.edit', compact('dato', 'regionales'));
    }

    // Valida y actualiza los datos de un centro
    public function update(Request $request, $id)
    {
        // Valida los mismos campos que en store
        $request->validate([
            'Codigo' => 'required|numeric',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
            'tblregionales_NIS' => 'required|exists:tbl_regionales,NIS'
        ]);

        // Actualiza el centro con los datos validados
        Centrosformacion::findOrFail($id)->update([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
            'tblregionales_NIS' => $request->tblregionales_NIS
        ]);

        return response()->json(['success' => true], 200);
    }

    // Elimina un centro de formación
    public function destroy($id)
    {
        Centrosformacion::destroy($id);
        return response()->json(['success' => true], 200);
    }
}
