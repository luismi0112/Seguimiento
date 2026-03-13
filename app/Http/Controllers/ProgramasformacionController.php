<?php

namespace App\Http\Controllers;

use App\Models\Programasformacion;
use Illuminate\Http\Request;

// Controlador para gestionar programas de formación
class ProgramasformacionController extends Controller
{
    // Muestra el listado de programas de formación
    public function index()
    {
        $programas = Programasformacion::all();
        return view('programasformacion.index', compact('programas'));
    }

    // Muestra formulario para crear nuevo programa
    public function create()
    {
        return view('programasformacion.create');
    }

    // Muestra detalles de un programa específico
    public function show($id)
    {
        $programa = Programasformacion::findOrFail($id);
        return view('programasformacion.show', compact('programa'));
    }

    // Valida y crea un nuevo programa de formación
    public function store(Request $request)
    {
        // Valida código, denominación y observaciones
        $request->validate([
            'Codigo' => 'required|string|max:50',
            'Denominacion' => 'required|string|max:150',
            'Observaciones' => 'nullable|string|max:255'
        ]);

        // Crea el nuevo programa con los datos validados
        Programasformacion::create($request->only(['Codigo', 'Denominacion', 'Observaciones']));

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa registrado! El programa se guardó correctamente.');
    }

    // Muestra formulario para editar un programa
    public function edit($id)
    {
        $programa = Programasformacion::findOrFail($id);
        return view('programasformacion.edit', compact('programa'));
    }

    // Valida y actualiza los datos de un programa
    public function update(Request $request, $id)
    {
        // Valida los mismos campos que en store
        $request->validate([
            'Codigo' => 'required|string|max:50',
            'Denominacion' => 'required|string|max:150',
            'Observaciones' => 'nullable|string|max:255'
        ]);

        // Busca el programa y lo actualiza
        $programa = Programasformacion::findOrFail($id);
        $programa->update($request->only(['Codigo', 'Denominacion', 'Observaciones']));

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa actualizado! El programa se guardó correctamente.');
    }

    // Elimina un programa de formación
    public function destroy($id)
    {
        $programa = Programasformacion::findOrFail($id);
        $programa->delete();

        return redirect()->route('programasformacion.index')
            ->with('success', '¡Programa eliminado! El programa se borró correctamente.');
    }
}
