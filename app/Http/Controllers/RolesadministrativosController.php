<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rolesadministrativos;

class RolesadministrativosController extends Controller
{
    public function index()
    {
        $datos = Rolesadministrativos::all();
        return view('RolesAdministrativos.index', compact('datos'));
    }

    public function create()
    {
        return view('RolesAdministrativos.create');
    }

    public function store(Request $request)
    {
        Rolesadministrativos::create($request->all());
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo creado correctamente');
    }

    public function edit($id)
    {
        $dato = Rolesadministrativos::findOrFail($id);
        return view('RolesAdministrativos.edit', compact('dato'));
    }

    public function update(Request $request, $id)
    {
        Rolesadministrativos::findOrFail($id)->update($request->all());
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo actualizado correctamente');
    }

    public function destroy($id)
    {
        Rolesadministrativos::destroy($id);
        return redirect()->route('rolesadministrativos.index')
            ->with('success', 'Rol administrativo eliminado correctamente');
    }
}
