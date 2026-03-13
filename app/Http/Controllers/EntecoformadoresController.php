<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entecoformadores;
use App\Models\Tiposdedocumentos;

// Controlador para gestionar entes coformadores
class EntecoformadoresController extends Controller
{
    // Muestra el listado de entes coformadores
    public function index()
    {
        $datos = Entecoformadores::all();
        return view('entecoformadores.index', compact('datos'));
    }

    // Muestra formulario para crear nuevo ente coformador
    public function create()
    {
        $tiposDocumento = Tiposdedocumentos::all();
        return view('entecoformadores.create', compact('tiposDocumento'));
    }
    
    // Muestra detalles de un ente coformador específico
    public function show($id)
    {
        $ente = Entecoformadores::findOrFail($id);
        return view('entecoformadores.show', compact('ente'));
    }

    // Valida y crea un nuevo ente coformador
    public function store(Request $request)
    {
        // Valida tipo de documento, número de documento, nombres, razón social, dirección, teléfono y correo
        $validated = $request->validate([
            'Tdoc' => 'required|integer',
            'Numdoc' => 'required|integer',
            'Nombres' => 'required|string|max:100',
            'RazonSocial' => 'nullable|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:50',
            'CorreoInstitucional' => 'nullable|email|max:50',
        ]);

        // Crea el nuevo ente coformador con los datos validados
        Entecoformadores::create($validated);

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador creado correctamente');
    }

    // Muestra formulario para editar un ente coformador
    public function edit(Entecoformadores $entecoformadore)
    {
        $dato = $entecoformadore;
        $tiposDocumento = Tiposdedocumentos::all();
        return view('entecoformadores.edit', compact('dato', 'tiposDocumento'));
    }

    // Valida y actualiza los datos de un ente coformador
    public function update(Request $request, Entecoformadores $entecoformadore)
    {
        // Valida los mismos campos que en store
        $validated = $request->validate([
            'Tdoc' => 'required|integer',
            'Numdoc' => 'required|integer',
            'Nombres' => 'required|string|max:100',
            'RazonSocial' => 'nullable|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:50',
            'CorreoInstitucional' => 'nullable|email|max:50',
        ]);

        // Actualiza el ente coformador con los datos validados
        $entecoformadore->update($validated);

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador actualizado correctamente');
    }

    // Elimina un ente coformador
    public function destroy(Entecoformadores $entecoformadore)
    {
        $entecoformadore->delete();

        return redirect()->route('entecoformadores.index')
            ->with('success', 'Ente coformador eliminado correctamente');
    }
}
