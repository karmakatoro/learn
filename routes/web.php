<?php

use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/autocomplete', [AutocompleteController::class, 'index']);
Route::post('/autocomplete/fetch', [AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');

Route::get('/load', [PostController::class, 'index']);
