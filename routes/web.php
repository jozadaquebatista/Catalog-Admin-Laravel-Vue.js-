<?php

use Illuminate\Support\Facades\Route;

// redireciona todas as requisições GET para o template padrão
Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');