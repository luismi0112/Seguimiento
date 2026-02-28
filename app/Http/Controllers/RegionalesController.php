<?php

namespace App\Http\Controllers;

use App\Models\Regionales;
use Illuminate\Http\Request;

class RegionalesController extends Controller
{
    public function index()
    {
        $regionales = Regionales::all(); 
        return view('regionales.index', compact('regionales')); 
    }

    public function create()
    {
        return view('regionales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
        ]);

        Regionales::create([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
        ]);

        return redirect()->route('regionales.index')->with('success', 'Regional creada correctamente.');
    }

    public function edit($id)
    {
        $regional = Regionales::findOrFail($id);
        return view('regionales.edit', compact('regional'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Codigo' => 'required|integer',
            'Denominacion' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:200',
        ]);

        $regional = Regionales::findOrFail($id);
        $regional->update([
            'Codigo' => $request->Codigo,
            'Denominacion' => $request->Denominacion,
            'Observaciones' => $request->Observaciones,
        ]);

        return redirect()->route('regionales.index')->with('success', 'Regional actualizada correctamente.');
    }

    public function destroy($id)
    {
        $regional = Regionales::findOrFail($id);
        $regional->delete();

        return redirect()->route('regionales.index')->with('success', 'Regional eliminada correctamente.');
    }
}
