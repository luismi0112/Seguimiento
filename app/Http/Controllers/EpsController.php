<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eps;

// Controlador para gestionar EPS (Empresas de Salud)
class EpsController extends Controller
{
    // Muestra el listado de EPS
    public function index()
    {
        $datos = Eps::all();
        return view('eps.index', compact('datos'));
    }

    // Muestra formulario para crear nueva EPS
    public function create()
    {
        return view('eps.create');
    }

    // Muestra detalles de una EPS específica
    public function show($id)
    {
        $eps = Eps::findOrFail($id);
        return view('eps.show', compact('eps'));
    }

    // Valida y crea una nueva EPS
    public function store(Request $request)
    {
        try {
            // Valida número de documento, denominación y observaciones
            $request->validate([
                'Numdoc' => 'required|numeric',
                'Denominacion' => 'required|string|max:100',
                'Observaciones' => 'nullable|string|max:200',
            ]);

            // Crea la EPS con los datos validados
            Eps::create($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Muestra formulario para editar una EPS
    public function edit($id)
    {
        $dato = Eps::findOrFail($id);
        return view('eps.edit', compact('dato'));
    }

    // Valida y actualiza los datos de una EPS
    public function update(Request $request, $id)
    {
        try {
            // Valida los mismos campos que en store
            $request->validate([
                'Numdoc' => 'required|numeric',
                'Denominacion' => 'required|string|max:100',
                'Observaciones' => 'nullable|string|max:200',
            ]);

            // Actualiza la EPS con los datos validados
            Eps::findOrFail($id)->update($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Elimina una EPS del sistema
    public function destroy($id)
    {
        try {
            Eps::destroy($id);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
