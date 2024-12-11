<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/form', [App\Http\Controllers\FormController::class, 'index']);
Route::post('/form', [App\Http\Controllers\FormController::class, 'store']);
Route::get('/table', [App\Http\Controllers\FormController::class, 'table']);



Route::get('/books/create', [App\Http\Controllers\BookController::class, 'create'])->name("create_book");
Route::prefix('books')->group(function() {
    Route::get('', [App\Http\Controllers\BookController::class, 'index'])->name('books');
    Route::get('{book}', [App\Http\Controllers\BookController::class, 'show'])->name('show_book');

    Route::post('', [App\Http\Controllers\BookController::class, 'store'])->name('save_book');
    Route::get('{id}/edit', [App\Http\Controllers\BookController::class, 'edit'])->name('edit_book');
    Route::post('{id}/edit',[App\Http\Controllers\BookController::class, 'update'])->name('update_book');
    Route::delete('{book}', [App\Http\Controllers\BookController::class, 'delete'])->name('delete_book');
});


Route::resource('authors', App\Http\Controllers\AuthorController::class)->only([
    'index', 'show'
]);
