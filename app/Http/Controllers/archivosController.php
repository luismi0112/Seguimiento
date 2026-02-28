<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\archivos;
use Carbon\Carbon;

class archivosController extends Controller
{
    public function index()
    {
        $archivos = archivos::all();
        return view('welcome', compact('archivos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'archivo' => 'required|file'
        ]);

        $file = $request->file('archivo');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->storeAs('archivos', $fileName, 'public');

        $now = Carbon::now();

        archivos::create([
            'nombre' => $request->nombre,
            'fecha' => $now->toDateString(),
            'hora' => $now->toTimeString(),
            'ruta' => $fileName
        ]);

        return redirect()->route('archivos.index')->with('success', 'Archivo subido correctamente');
    }
}
