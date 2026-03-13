<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Regionales;
use App\Models\centrosformacion;
use App\Models\programasformacion;
use App\Models\fichasdecaracterizacion;
use App\Models\aprendices;
use App\Models\instructores;
use App\Models\eps;
use App\Models\rolesadministrativos;
use App\Models\tiposdedocumentos;
use App\Models\entecoformadores;

// Controlador del Dashboard - Muestra estadísticas generales del sistema
class DashboardController extends Controller
{
    // Obtiene conteos de todas las entidades y los envía al dashboard
    public function index()
    {
        // Cuenta todos los registros de cada entidad
        $regionalesCount       = Regionales::count();
        $centrosCount          = centrosformacion::count();
        $programasCount        = programasformacion::count();
        $fichasCount           = fichasdecaracterizacion::count();
        $aprendicesCount       = aprendices::count();
        $instructoresCount     = instructores::count();
        $epsCount              = eps::count();
        $rolesCount            = rolesadministrativos::count();
        $tiposDocumentosCount  = tiposdedocumentos::count();
        $entecoformadoresCount = entecoformadores::count();

        // Cuenta los archivos almacenados en la carpeta 'archivos'
        $archivosCount = 0;
        if (Storage::disk('public')->exists('archivos')) {
            $archivosCount = count(Storage::disk('public')->files('archivos'));
        }

        // Retorna la vista del dashboard con los conteos de todas las entidades
        return view('dashboard', [
            'regionalesCount'       => $regionalesCount,
            'centrosCount'          => $centrosCount,
            'programasCount'        => $programasCount,
            'fichasCount'           => $fichasCount,
            'aprendicesCount'       => $aprendicesCount,
            'instructoresCount'     => $instructoresCount,
            'epsCount'              => $epsCount,
            'rolesCount'            => $rolesCount,
            'tiposDocumentosCount'  => $tiposDocumentosCount,
            'entecoformadoresCount' => $entecoformadoresCount,
            'archivosCount'         => $archivosCount,
        ]);
    }
}
