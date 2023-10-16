<?php

use App\Http\Controllers\CadastroCliente;
use Illuminate\Support\Facades\Route;

Route::get('cadastro', [CadastroCliente::class, 'index']);
Route::post('cadastro', [CadastroCliente::class, 'store']);
