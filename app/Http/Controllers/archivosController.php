<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArchivoSubidoMail;
use App\Models\Archivo; // Importa el modelo
use Carbon\Carbon;

class ArchivosController extends Controller
{
    // Listado de archivos desde BD
    public function index()
    {
        $archivos = Archivo::latest()->get(); // ahora trae objetos de la BD
        return view('Archivo.index', compact('archivos'));
    }

    // Formulario para subir archivo
    public function create()
    {
        return view('Archivo.create');
    }

    // Guardar archivo en storage y BD
    public function store(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'archivo' => 'required|file|max:10240',
            'correo'  => 'nullable|email'
        ]);

        $file = $request->file('archivo');
        $customName = Str::slug($request->input('nombre'));
        $filename = time() . '_' . $customName . '.' . $file->getClientOriginalExtension();

        // Guardar archivo físico
        $file->storeAs('archivos', $filename, 'public');

        // Guardar registro en BD
        Archivo::create([
            'nombre' => $filename,
            'fecha'  => now()->toDateString(),
            'hora'   => now()->toTimeString(),
        ]);

        // Enviar correo con Mailable
        if ($request->filled('correo')) {
            Mail::to($request->correo)->send(new ArchivoSubidoMail($filename));
        }

        return redirect()->route('archivos.index')->with('success', 'Archivo subido correctamente');
    }

    // Eliminar archivo y registro
    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);

        $path = 'archivos/' . $archivo->nombre;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $archivo->delete();

        return redirect()->route('archivos.index')->with('success', 'Archivo eliminado correctamente');
    }
}
