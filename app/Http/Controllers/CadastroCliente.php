<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;


class CadastroCliente extends Controller
{
    public function index()
    {
        return Cadastro::all();
    }  

    public function store(Request $request)
    {
        $request ->validate([
            'nome' => 'required | unique:clientes',
            'endereco' => 'required',
            'cidade' => 'required', 
            'cep' => 'required',
            'telefone' => 'required | unique:clientes',
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
}
