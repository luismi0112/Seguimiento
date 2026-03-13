<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichasdecaracterizacion;
use App\Models\Programasformacion;
use App\Models\Centrosformacion;

// Controlador para gestionar fichas de caracterización
class FichasdecaracterizacionController extends Controller
{
    // Muestra el listado de fichas con sus programas y centros relacionados
    public function index()
    {
        $datos = Fichasdecaracterizacion::with(['programa', 'centro'])->get();
        return view('Fichascaracterizacion.index', compact('datos'));
    }

    // Muestra detalles de una ficha específica
    public function show($id)
    {
        $ficha = Fichasdecaracterizacion::with(['programa', 'centro'])->findOrFail($id);
        return view('Fichascaracterizacion.show', compact('ficha'));
    }

    // Muestra formulario para crear nueva ficha
    public function create()
    {
        $programas = Programasformacion::all();
        $centros = Centrosformacion::all();
        return view('Fichascaracterizacion.create', compact('programas', 'centros'));
    }

    // Crea una nueva ficha de caracterización
    public function store(Request $request)
    {
        Fichasdecaracterizacion::create($request->all());
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha creada correctamente');
    }

    // Muestra formulario para editar una ficha
    public function edit($id)
    {
        $dato = Fichasdecaracterizacion::findOrFail($id);
        $programas = Programasformacion::all();
        $centros = Centrosformacion::all();
        return view('Fichascaracterizacion.edit', compact('dato', 'programas', 'centros'));
    }

    // Actualiza los datos de una ficha
    public function update(Request $request, $id)
    {
        Fichasdecaracterizacion::findOrFail($id)->update($request->all());
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha actualizada correctamente');
    }

    // Elimina una ficha de caracterización
    public function destroy($id)
    {
        Fichasdecaracterizacion::destroy($id);
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha eliminada correctamente');
    }
}
