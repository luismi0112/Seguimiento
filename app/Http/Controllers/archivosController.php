<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

// Controlador para gestionar archivos en el sistema
class ArchivosController extends Controller
{
    // Obtiene y muestra el listado de archivos almacenados
    public function index()
    {
        $dir = 'archivos';
        $files = [];

        if (Storage::disk('public')->exists($dir)) {
            $paths = Storage::disk('public')->files($dir);

            // Mapea cada archivo con su información: ruta, URL, nombre y fecha de modificación
            $files = collect($paths)->map(function ($path) {
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

        return view('Archivo.index', compact('files'));
    }

    // Muestra formulario para subir un nuevo archivo
    public function create()
    {
        return view('Archivo.create');
    }

    // Valida, guarda el archivo y envía email de notificación
    public function store(Request $request)
    {
        // Valida el nombre, archivo y correo opcional
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'archivo' => 'required|file|max:10240',
            'correo'  => 'nullable|email'
        ]);

        // Obtiene el archivo y crea un nombre único con timestamp
        $file = $request->file('archivo');
        $customName = Str::slug($request->input('nombre'));
        $filename = time() . '_' . $customName . '.' . $file->getClientOriginalExtension();

        // Almacena el archivo en la carpeta 'archivos' del disco público
        $file->storeAs('archivos', $filename, 'public');

        // Si se proporcionó un correo, envía notificación
        if ($request->filled('correo')) {
            Mail::raw("Se ha subido un nuevo archivo llamado: {$filename}", function ($message) use ($request) {
                $message->to($request->correo)
                    ->subject('Nuevo archivo subido al sistema');
            });
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

    // Elimina un archivo del almacenamiento
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
