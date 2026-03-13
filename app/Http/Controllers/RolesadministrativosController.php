<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rolesadministrativos;

// Controlador para gestionar roles administrativos
class RolesadministrativosController extends Controller
{
    // Muestra el listado de roles administrativos
    public function index()
    {
        $datos = Rolesadministrativos::all();
        return view('RolesAdministrativos.index', compact('datos'));
    }

    // Muestra formulario para crear nuevo rol
    public function create()
    {
        return view('RolesAdministrativos.create');
    }

    // Muestra detalles de un rol específico
    public function show($id)
    {
        $rol = Rolesadministrativos::findOrFail($id);
        return view('rolesadministrativos.show', compact('rol'));
    }

    // Crea un nuevo rol administrativo
    public function store(Request $request)
    {
        Rolesadministrativos::create($request->all());
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo creado correctamente');
    }

    // Muestra formulario para editar un rol
    public function edit($id)
    {
        $dato = Rolesadministrativos::findOrFail($id);
        return view('RolesAdministrativos.edit', compact('dato'));
    }

    // Actualiza los datos de un rol administrativo
    public function update(Request $request, $id)
    {
        Rolesadministrativos::findOrFail($id)->update($request->all());
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo actualizado correctamente');
    }

    // Elimina un rol administrativo
    public function destroy($id)
    {
        Rolesadministrativos::destroy($id);
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo eliminado correctamente');
    }
}
