<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});

Route::get('/item/search', [\App\Http\Controllers\ItemController::class, 'search']);
Route::get('/item/edit/{id}',[App\Http\Controllers\ItemController::class, 'edit']);
Route::post('/itemEdit', [App\Http\Controllers\ItemController::class, 'itemEdit']);
Route::get('/itemDelete/{id}', [\App\Http\Controllers\ItemController::class, 'itemDelete']);

