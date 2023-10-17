<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;



class CadastroCliente extends Controller
{
    public function index()
    {
        return Cadastro::all();
    }  

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|unique:clientes|max:100|min:4',
                'endereco' => 'required',
                'cidade' => 'required', 
                'cep' => 'required',
                'telefone' => 'required|max:11|min:11',
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.unique' => 'O nome já está em uso.',
                'nome.max' => 'O nome não pode ter mais de 100 caracteres.',
                'nome.min' => 'O nome deve ter pelo menos 4 caracteres.',
                'endereco.required' => 'O campo endereço é obrigatório.',
                'cidade.required' => 'O campo cidade é obrigatório.',
                'cep.required' => 'O campo CEP é obrigatório.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.max' => 'O telefone deve ter no máximo 11 caracteres.',
                'telefone.min' => 'O telefone deve ter no mínimo 11 caracteres.',
                // Adicione outras mensagens conforme necessário.
            ]);
    
            $cadastro = Cadastro::create($request->all());
    
            return response()->json($cadastro, 201);
    
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
    
            return response()->json(['error' => $errors], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno no servidor.'], 500);
        }  
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
