<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiposdedocumentos;

class TiposdedocumentosController extends Controller
{
    public function index()
    {
        $tiposdocumentos = Tiposdedocumentos::all();
        return view('tiposdocumentos.index', compact('tiposdocumentos'));
    }

    public function create()
    {
        return view('tiposdocumentos.create');
    }

    public function store(Request $request)
    {
        Tiposdedocumentos::create($request->all());
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento creado correctamente');
    }


    public function edit($id)
    {
        $tipo = Tiposdedocumentos::findOrFail($id);
        return view('tiposdocumentos.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = Tiposdedocumentos::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento actualizado correctamente');
    }

    public function destroy($id)
    {
        Tiposdedocumentos::destroy($id);
        return redirect()->route('tiposdocumentos.index')
            ->with('success', 'Tipo de documento eliminado correctamente');
    }
}
