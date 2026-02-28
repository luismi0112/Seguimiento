<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eps;

class EpsController extends Controller
{
    public function index()
    {
        $datos = Eps::all();
        return view('eps.index', compact('datos'));
    }

    public function create()
    {
        return view('eps.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'Numdoc' => 'required|numeric',
                'Denominacion' => 'required|string|max:100',
                'Observaciones' => 'nullable|string|max:200',
            ]);

            Eps::create($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $dato = Eps::findOrFail($id);
        return view('eps.edit', compact('dato'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'Numdoc' => 'required|numeric',
                'Denominacion' => 'required|string|max:100',
                'Observaciones' => 'nullable|string|max:200',
            ]);

            Eps::findOrFail($id)->update($request->all());

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Eps::destroy($id);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
