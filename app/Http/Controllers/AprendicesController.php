<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aprendices; // Importa tu modelo tal cual
use App\Models\Tiposdedocumentos;
use App\Models\Fichasdecaracterizacion;
use App\Models\Eps;

class AprendicesController extends Controller
{
    public function index()
    {
        $aprendices = aprendices::with(['tipoDocumento', 'ficha', 'eps'])->get();
        return view('aprendices.index', compact('aprendices'));
    }

    public function create()
    {
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        $eps = Eps::all();

        return view('aprendices.create', compact('tiposdocumentos', 'fichas', 'eps'));
    }

    public function show($id)
    {
        $aprendiz = aprendices::with(['tipoDocumento', 'eps', 'ficha'])->findOrFail($id);
        return view('aprendices.show', compact('aprendiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tbltiposdocumentos_NIS' => 'required|exists:tbl_tiposdedocumentos,NIS',
            'Numdoc' => 'required|numeric',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:20',
            'CorreoInstitucional' => 'required|email|max:150',
            'CorreoPersonal' => 'nullable|email|max:150',
            'Sexo' => 'required|in:1,2',
            'FechaNacimiento' => 'required|date',
            'tbleps_NIS' => 'required|exists:tbl_eps,NIS',
            'tblfichasdecaracterizacion_NIS' => 'required|exists:tbl_fichasdecaracterizacion,NIS'
        ]);

        aprendices::create($request->all());

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $aprendiz = aprendices::findOrFail($id);
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        $eps = Eps::all();

        return view('aprendices.edit', compact('aprendiz', 'tiposdocumentos', 'fichas', 'eps'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tbltiposdocumentos_NIS' => 'required|exists:tbl_tiposdedocumentos,NIS',
            'Numdoc' => 'required|numeric',
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Direccion' => 'nullable|string|max:200',
            'Telefono' => 'nullable|string|max:20',
            'CorreoInstitucional' => 'required|email|max:150',
            'CorreoPersonal' => 'nullable|email|max:150',
            'Sexo' => 'required|in:1,2',
            'FechaNacimiento' => 'required|date',
            'tbleps_NIS' => 'required|exists:tbl_eps,NIS',
            'tblfichasdecaracterizacion_NIS' => 'required|exists:tbl_fichasdecaracterizacion,NIS'
        ]);

        $aprendiz = aprendices::findOrFail($id);
        $aprendiz->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $aprendiz = aprendices::findOrFail($id);
        $aprendiz->delete();

        return response()->json(['success' => true]);
    }
}
