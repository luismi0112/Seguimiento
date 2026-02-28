<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entecoformadores;
use App\Models\Tiposdedocumentos;

class EntecoformadoresController extends Controller
{
    public function index()
    {
        $datos = Entecoformadores::all();
        return view('entecoformadores.index', compact('datos'));
    }

    public function create()
    {
        $tiposDocumento = Tiposdedocumentos::all();
        return view('entecoformadores.create', compact('tiposDocumento'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Tdoc' => 'required|integer',
            'Numdoc' => 'required|integer',
            'Nombres' => 'required|string|max:100',
            'RazonSocial' => 'nullable|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:50',
            'CorreoInstitucional' => 'nullable|email|max:50',
        ]);

        Entecoformadores::create($validated);

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador creado correctamente');
    }

    public function edit(Entecoformadores $entecoformadore)
    {
        $dato = $entecoformadore;
        $tiposDocumento = Tiposdedocumentos::all();
        return view('entecoformadores.edit', compact('dato', 'tiposDocumento'));
    }

    public function update(Request $request, Entecoformadores $entecoformadore)
    {
        $validated = $request->validate([
            'Tdoc' => 'required|integer',
            'Numdoc' => 'required|integer',
            'Nombres' => 'required|string|max:100',
            'RazonSocial' => 'nullable|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:50',
            'CorreoInstitucional' => 'nullable|email|max:50',
        ]);

        $entecoformadore->update($validated);

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador actualizado correctamente');
    }

    public function destroy(Entecoformadores $entecoformadore)
    {
        $entecoformadore->delete();

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador eliminado correctamente');
    }
}
