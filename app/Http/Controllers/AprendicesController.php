<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aprendices;
use App\Models\Tiposdedocumentos;
use App\Models\Fichasdecaracterizacion;
use Illuminate\Support\Facades\Hash;

class AprendicesController extends Controller
{
    // Muestra el listado de aprendices
    public function index()
    {
        $aprendices = aprendices::with(['tipoDocumento', 'ficha'])->get();
        return view('aprendices.index', compact('aprendices'));
    }

    // Muestra formulario para crear nuevo aprendiz
    public function create()
    {
        $LuismigAY = aprendices::all();
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        return view('aprendices.create', compact('tiposdocumentos', 'fichas', 'LuismigAY'));
    }

    // Muestra detalles de un aprendiz específico
    public function show($id)
    {
        $aprendiz = Aprendices::with(['tipoDocumento', 'eps', 'ficha'])->findOrFail($id);
        return view('aprendices.show', compact('aprendiz'));
    }


    // Valida y crea nuevo aprendiz en la BD
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
            $aprendiz->Nombres = Hash::make($request->Nombres);
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

    // Muestra formulario para editar aprendiz
    public function edit($id)
    {
        $aprendiz = aprendices::findOrFail($id);
        $tiposdocumentos = Tiposdedocumentos::all();
        $fichas = Fichasdecaracterizacion::all();
        return view('aprendices.edit', compact('aprendiz', 'tiposdocumentos', 'fichas'));
    }

    // Valida y actualiza los datos de un aprendiz
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

    // Elimina un aprendiz de la BD
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
