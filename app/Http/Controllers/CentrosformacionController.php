<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centrosformacion;
use App\Models\Regionales;

class CentrosformacionController extends Controller
{
    public function index()
    {
        $centros = Centrosformacion::with('regional')->get();
        return view('centrosformacion.index', compact('centros'));
    }

    public function create()
    {
        $regionales = Regionales::all();
        return view('centrosformacion.create', compact('regionales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo' => 'required|numeric',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
            'tblregionales_NIS' => 'required|exists:tbl_regionales,NIS'
        ]);

        Centrosformacion::create([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
            'tblregionales_NIS' => $request->tblregionales_NIS
        ]);

        // Devolver JSON para SweetAlert2
        return response()->json(['success' => true], 200);
    }



    public function edit($id)
    {
        $dato = Centrosformacion::findOrFail($id);
        $regionales = Regionales::all();
        return view('centrosformacion.edit', compact('dato', 'regionales'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo' => 'required|numeric',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
            'tblregionales_NIS' => 'required|exists:tbl_regionales,NIS'
        ]);

        Centrosformacion::findOrFail($id)->update([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
            'tblregionales_NIS' => $request->tblregionales_NIS
        ]);

        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        Centrosformacion::destroy($id);
        return response()->json(['success' => true], 200);
    }
}
