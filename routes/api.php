<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroCliente;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('cadastro', [CadastroCliente::class, 'index']);
Route::post('cadastro', [CadastroCliente::class, 'store']);
