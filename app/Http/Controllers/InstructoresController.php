<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\instructores; 

class InstructoresController extends Controller
{
    public function index()
    {
        $instructores = instructores::all();
        return view('instructores.index', compact('instructores'));
    }

    public function create()
    {
        $eps = \App\Models\Eps::all();
        $roles = \App\Models\RolesAdministrativos::all();
        return view('instructores.create', compact('eps', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Numdoc' => 'required|unique:tbl_instructores,Numdoc',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
        ]);

        instructores::create($request->all());

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor creado correctamente.');
    }

    public function edit($id)
    {
        $instructor = instructores::findOrFail($id);
        $eps = \App\Models\Eps::all();
        $roles = \App\Models\RolesAdministrativos::all();
        return view('instructores.edit', compact('instructor', 'eps', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $instructor = instructores::findOrFail($id);

        $request->validate([
            'Numdoc' => 'required|unique:tbl_instructores,Numdoc,' . $id . ',NIS',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
        ]);

        $instructor->update($request->all());

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor actualizado correctamente.');
    }

    public function destroy($id)
    {
        instructores::findOrFail($id)->delete();
        return redirect()->route('instructores.index')
            ->with('success', 'Instructor eliminado correctamente.');
    }
}