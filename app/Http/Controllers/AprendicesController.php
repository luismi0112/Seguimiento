<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aprendices;
use App\Models\Tiposdedocumentos;
use App\Models\Fichasdecaracterizacion;

class AprendicesController extends Controller
{
    public function index()
    {
        $aprendices = aprendices::with(['tipoDocumento', 'ficha'])->get();
        return view('aprendices.index', compact('aprendices'));
    }

    public function create()
    {
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        return view('aprendices.create', compact('tiposdocumentos', 'fichas'));
    }

    public function store(Request $request)
    {
        try {
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
                'tblfichasdecaracterizacion_NIS' => 'required|exists:tbl_fichasdecaracterizacion,NIS'
            ]);

            $aprendiz = new aprendices();
            $aprendiz->tbltiposdocumentos_NIS = $request->tbltiposdocumentos_NIS;
            $aprendiz->Numdoc = $request->Numdoc;
            $aprendiz->Nombres = $request->Nombres;
            $aprendiz->Apellidos = $request->Apellidos;
            $aprendiz->Direccion = $request->Direccion;
            $aprendiz->Telefono = $request->Telefono;
            $aprendiz->CorreoInstitucional = $request->CorreoInstitucional;
            $aprendiz->CorreoPersonal = $request->CorreoPersonal;
            $aprendiz->Sexo = $request->Sexo;
            $aprendiz->FechaNacimiento = $request->FechaNacimiento;
            $aprendiz->tblfichasdecaracterizacion_NIS = $request->tblfichasdecaracterizacion_NIS;
            $aprendiz->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $aprendiz = aprendices::findOrFail($id);
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        return view('aprendices.edit', compact('aprendiz', 'tiposdocumentos', 'fichas'));
    }

    public function update(Request $request, $id)
    {
        try {
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
                'tblfichasdecaracterizacion_NIS' => 'required|exists:tbl_fichasdecaracterizacion,NIS'
            ]);

            $aprendiz = aprendices::findOrFail($id);
            $aprendiz->tbltiposdocumentos_NIS = $request->tbltiposdocumentos_NIS;
            $aprendiz->Numdoc = $request->Numdoc;
            $aprendiz->Nombres = $request->Nombres;
            $aprendiz->Apellidos = $request->Apellidos;
            $aprendiz->Direccion = $request->Direccion;
            $aprendiz->Telefono = $request->Telefono;
            $aprendiz->CorreoInstitucional = $request->CorreoInstitucional;
            $aprendiz->CorreoPersonal = $request->CorreoPersonal;
            $aprendiz->Sexo = $request->Sexo;
            $aprendiz->FechaNacimiento = $request->FechaNacimiento;
            $aprendiz->tblfichasdecaracterizacion_NIS = $request->tblfichasdecaracterizacion_NIS;
            $aprendiz->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $aprendiz = aprendices::findOrFail($id);
            $aprendiz->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
