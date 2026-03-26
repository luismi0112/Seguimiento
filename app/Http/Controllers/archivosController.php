<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArchivoSubidoMail; 

class ArchivosController extends Controller
{
    // Listado de archivos
    public function index()
    {
        $dir = 'archivos';
        $archivos = [];

        if (Storage::disk('public')->exists($dir)) {
            $paths = Storage::disk('public')->files($dir);

            $archivos = collect($paths)->map(function ($path) {
                return [
                    'path'       => $path,
                    'url'        => Storage::url($path),
                    'name'       => basename($path),
                    'created_at' => Carbon::createFromTimestamp(
                        Storage::disk('public')->lastModified($path)
                    )->format('d/m/Y H:i'),
                ];
            })->toArray();
        }

        return view('Archivo.index', compact('archivos'));
    }

    // Formulario para subir archivo
    public function create()
    {
        return view('Archivo.create');
    }

    // Guardar archivo y enviar notificación
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

        $file->storeAs('archivos', $filename, 'public');

        // Enviar correo con Mailable
        if ($request->filled('correo')) {
            Mail::to($request->correo)->send(new ArchivoSubidoMail($filename));
        }

        return redirect()->route('archivos.index')->with('success', 'Archivo subido correctamente');
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }

    public function update(Request $request, $id)
    {
        abort(404);
    }

    // Eliminar archivo
    public function destroy($id)
    {
        $path = 'archivos/' . $id;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('archivos.index')->with('success', 'Archivo eliminado correctamente');
        }

        return redirect()->route('archivos.index')->with('error', 'El archivo no existe');
    }
}
