<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('index');
});

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);

Route::get('/form', [App\Http\Controllers\FormController::class, 'index']);

Route::post('/form', [App\Http\Controllers\FormController::class, 'store']);

Route::get('/data', [App\Http\Controllers\DataController::class, 'index']);
