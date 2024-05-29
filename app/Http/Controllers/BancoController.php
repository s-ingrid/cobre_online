<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();
        return response()->json($bancos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bco_numero' => 'required|size:3',
            'bco_nome' => 'required|string|max:50',
            'bco_ativo' => 'required|in:s,n',
            'bco_arquivo' => 'nullable|string|max:50',
        ]);

        $banco = Banco::create($request->all());
        return response()->json($banco, 201);
    }

    public function show($id)
    {
        $banco = Banco::findOrFail($id);
        return response()->json($banco);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bco_numero' => 'required|size:3',
            'bco_nome' => 'required|string|max:50',
            'bco_ativo' => 'required|in:s,n',
            'bco_arquivo' => 'nullable|string|max:50',
        ]);

        $banco = Banco::findOrFail($id);
        $banco->update($request->all());
        return response()->json($banco);
    }

    public function destroy($id)
    {
        Banco::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
