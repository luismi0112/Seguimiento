<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiposdedocumentos;

class TiposdedocumentosController extends Controller
{
    // Muestra el listado de tipos de documentos
    public function index()
    {
        $tiposdocumentos = Tiposdedocumentos::all();
        return view('tiposdocumentos.index', compact('tiposdocumentos'));
    }

    // Muestra formulario para crear nuevo tipo de documento
    public function create()
    {
        return view('tiposdocumentos.create');
    }

    // Muestra detalles de un tipo de documento específico
    public function show($id)
    {
        $tipo = Tiposdedocumentos::findOrFail($id);
        return view('tiposdocumentos.show', compact('tipo'));
    }

    // Crea un nuevo tipo de documento
    public function store(Request $request)
    {
        Tiposdedocumentos::create($request->all());
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento creado correctamente');
    }

    // Muestra formulario para editar un tipo de documento
    public function edit($id)
    {
        $tipo = Tiposdedocumentos::findOrFail($id);
        return view('tiposdocumentos.edit', compact('tipo'));
    }

    // Actualiza los datos de un tipo de documento
    public function update(Request $request, $id)
    {
        $tipo = Tiposdedocumentos::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento actualizado correctamente');
    }

    // Elimina un tipo de documento
    public function destroy($id)
    {
        Tiposdedocumentos::destroy($id);
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento eliminado correctamente');
    }
}
