<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivosController extends Controller
{
    
    public function index()
    {
        $dir = 'archivos';
        $files = [];

        if (Storage::disk('public')->exists($dir)) {
            $paths = Storage::disk('public')->files($dir);

            $files = collect($paths)->map(function ($path) {
                return [
                    'path' => $path,
                    'url'  => Storage::disk('public')->url($path),
                    'name' => basename($path),
                    'size' => Storage::disk('public')->size($path),
                ];
            })->toArray();
        }

        return view('archivos.index', compact('files'));
    }

    public function create()
    {
        return view('archivos.create');
    }

    /**
     * Guardar archivo subido en disco public/archivos
     */
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:10240', // 10 MB
        ]);

        $file = $request->file('archivo');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        $path = $file->storeAs('archivos', $filename, 'public');

        return redirect()->route('archivos.index')->with('success', 'Archivo subido correctamente');
    }

    /**
     * Descargar archivo
     */
    public function download($filename)
    {
        $path = 'archivos/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }

        return redirect()->route('archivos.index')->with('error', 'El archivo no existe');
    }

    /**
     * Eliminar archivo
     */
    public function destroy($filename)
    {
        $path = 'archivos/' . $filename;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('archivos.index')->with('success', 'Archivo eliminado correctamente');
        }

        return redirect()->route('archivos.index')->with('error', 'El archivo no existe');
    }
}
