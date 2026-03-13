<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\instructores;

// Controlador para gestionar instructores
class InstructoresController extends Controller
{
    // Muestra el listado de instructores
    public function index()
    {
        $instructores = instructores::all();
        return view('instructores.index', compact('instructores'));
    }

    // Muestra detalles de un instructor específico
    public function show($id)
    {
        $instructor = instructores::findOrFail($id);
        return view('instructores.show', compact('instructor'));
    }

    // Muestra formulario para crear nuevo instructor
    public function create()
    {
        $eps = \App\Models\Eps::all();
        $roles = \App\Models\RolesAdministrativos::all();
        return view('instructores.create', compact('eps', 'roles'));
    }

    // Valida y crea un nuevo instructor
    public function store(Request $request)
    {
        // Valida que el número de documento sea único y requerido
        $request->validate([
            'Numdoc' => 'required|unique:tbl_instructores,Numdoc',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
        ]);

        // Crea el nuevo instructor
        instructores::create($request->all());

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor creado correctamente.');
    }

    // Muestra formulario para editar un instructor
    public function edit($id)
    {
        $instructor = instructores::findOrFail($id);
        $eps = \App\Models\Eps::all();
        $roles = \App\Models\RolesAdministrativos::all();
        return view('instructores.edit', compact('instructor', 'eps', 'roles'));
    }

    // Valida y actualiza los datos de un instructor
    public function update(Request $request, $id)
    {
        $instructor = instructores::findOrFail($id);

        // Valida que el número de documento sea único (excepto el del registro actual)
        $request->validate([
            'Numdoc' => 'required|unique:tbl_instructores,Numdoc,' . $id . ',NIS',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
        ]);

        // Actualiza el instructor con los datos validados
        $instructor->update($request->all());

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor actualizado correctamente.');
    }

    // Elimina un instructor
    public function destroy($id)
    {
        instructores::findOrFail($id)->delete();
        return redirect()->route('instructores.index')
            ->with('success', 'Instructor eliminado correctamente.');
    }
}
