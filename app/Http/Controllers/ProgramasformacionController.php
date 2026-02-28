<?php

namespace App\Http\Controllers;

use App\Models\Programasformacion;
use Illuminate\Http\Request;

class ProgramasformacionController extends Controller
{
    public function index()
    {
        $programas = Programasformacion::all();
        return view('programasformacion.index', compact('programas'));
    }

    public function create()
    {
        return view('programasformacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo' => 'required|string|max:50',
            'Denominacion' => 'required|string|max:150',
            'Observaciones' => 'nullable|string|max:255'
        ]);

        Programasformacion::create($request->only(['Codigo', 'Denominacion', 'Observaciones']));

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa registrado! El programa se guardó correctamente.');
    }

    public function edit($id)
    {
        $programa = Programasformacion::findOrFail($id);
        return view('programasformacion.edit', compact('programa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo' => 'required|string|max:50',
            'Denominacion' => 'required|string|max:150',
            'Observaciones' => 'nullable|string|max:255'
        ]);

        $programa = Programasformacion::findOrFail($id);
        $programa->update($request->only(['Codigo', 'Denominacion', 'Observaciones']));

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa actualizado! El programa se guardó correctamente.');
    }

    public function destroy($id)
    {
        $programa = Programasformacion::findOrFail($id);
        $programa->delete();

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa eliminado! El programa se borró correctamente.');
    }
}
