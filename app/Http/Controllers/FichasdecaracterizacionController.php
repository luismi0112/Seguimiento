<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichasdecaracterizacion;
use App\Models\Programasformacion;
use App\Models\Centrosformacion;

class FichasdecaracterizacionController extends Controller
{
    public function index()
    {
        $datos = Fichasdecaracterizacion::with(['programa', 'centro'])->get();
        return view('Fichascaracterizacion.index', compact('datos'));
    }

    public function create()
    {
        $programas = Programasformacion::all();
        $centros = Centrosformacion::all();
        return view('Fichascaracterizacion.create', compact('programas', 'centros'));
    }

    public function store(Request $request)
    {
        Fichasdecaracterizacion::create($request->all());
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha creada correctamente');
    }

    public function edit($id)
    {
        $dato = Fichasdecaracterizacion::findOrFail($id);
        $programas = Programasformacion::all();
        $centros = Centrosformacion::all();
        return view('Fichascaracterizacion.edit', compact('dato', 'programas', 'centros'));
    }

    public function update(Request $request, $id)
    {
        Fichasdecaracterizacion::findOrFail($id)->update($request->all());
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha actualizada correctamente');
    }

    public function destroy($id)
    {
        Fichasdecaracterizacion::destroy($id);
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha eliminada correctamente');
    }
}
