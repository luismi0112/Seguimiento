<?php

namespace App\Http\Controllers;

use App\Models\Regionales;
use Illuminate\Http\Request;

// Controlador para gestionar regionales
class RegionalesController extends Controller
{
    // Muestra el listado de regionales
    public function index()
    {
        $regionales = Regionales::all();
        return view('regionales.index', compact('regionales'));
    }

    // Muestra formulario para crear nueva regional
    public function create()
    {
        return view('regionales.create');
    }

    // Muestra detalles de una regional específica
    public function show($id)
    {
        $regional = Regionales::findOrFail($id);
        return view('regionales.show', compact('regional'));
    }

    // Valida y crea una nueva regional
    public function store(Request $request)
    {
        // Valida código, denominación y observaciones
        $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
        ]);

        // Crea la nueva regional con los datos validados
        Regionales::create([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
        ]);

        return redirect()->route('regionales.index')->with('success', 'Regional creada correctamente.');
    }

    // Muestra formulario para editar una regional
    public function edit($id)
    {
        $regional = Regionales::findOrFail($id);
        return view('regionales.edit', compact('regional'));
    }

    // Valida y actualiza los datos de una regional
    public function update(Request $request, $id)
    {
        // Valida los mismos campos que en store
        $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
        ]);

        // Busca la regional y la actualiza con los datos validados
        $regional = Regionales::findOrFail($id);
        $regional->update([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
        ]);

        return redirect()->route('regionales.index')->with('success', 'Regional actualizada correctamente.');
    }

    // Elimina una regional
    public function destroy($id)
    {
        $regional = Regionales::findOrFail($id);
        $regional->delete();

        return redirect()->route('regionales.index')->with('success', 'Regional eliminada correctamente.');
    }
}
