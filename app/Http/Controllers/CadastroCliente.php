<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class CadastroCliente extends Controller
{
    public function index()
    {
        return Cadastro::all();
    }  

    public function store(Request $request)
    {
        $request ->validate([
            'nome' => 'required|unique:clientes|max:100|min:4',
            'endereco' => 'required',
            'cidade' => 'required', 
            'cep' => 'required',
            'telefone' => 'required|max:11|min:11',
        ]);
        $cadastro = Cadastro::create($request->all());
        return response()->json($cadastro, 201);
    }  

    public function show($id)
    {
        try {
            $Cadastro = Cadastro::findOrFail($id);
            return $Cadastro;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Cadastro não encontrado.'], 404);
        }  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'endereco' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'telefone' => 'required|max:11|min:11',
        ]);

        try {
            $cadastro = Cadastro::findOrFail($id);

            $cadastro->update([
                'endereco' => $request->input('endereco'),
                'cidade' => $request->input('cidade'),
                'cep' => $request->input('cep'),
                'telefone' => $request->input('telefone'),
            ]);

            return response()->json($cadastro, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Cadastro não encontrado.'], 404);
        }

    }

    public function destroy($id)
    {
        try{
            $cadastro = Cadastro::findOrFail($id);
            $cadastro->delete($id);
            return $cadastro;

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Cadastro não encontrado.'], 404);
        }
       
    } 



}
