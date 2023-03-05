<?php

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
    return Redirect::to('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // VAGAS
    Route::get('/vagas', [App\Http\Controllers\VagasController::class, 'index'])->name('vagas');
    Route::post('/vagas/add', [App\Http\Controllers\VagasController::class, 'add'])->name('vagas');
    Route::get('/vagas/{id}/edit', [App\Http\Controllers\VagasController::class, 'edit'])->name('vagas');
    Route::post('/vagas/update/{id}', [App\Http\Controllers\VagasController::class, 'update'])->name('vagas');
    Route::delete('/vagas/delete/{id}', [App\Http\Controllers\VagasController::class, 'delete'])->name('vagas');
    Route::get('vagas/data', 'VagasController@getVagasData')->name('vagas');


    // CANDIDATOS
    Route::get('/candidatos/{id}', [App\Http\Controllers\CandidatosController::class, 'index'])->name('candidatos');
    Route::post('/candidatos/{id}/add', [App\Http\Controllers\CandidatosController::class, 'add'])->name('candidatos.add');
    Route::get('/candidatos/{id}/{vaga_id}/edit', [App\Http\Controllers\CandidatosController::class, 'edit'])->name('candidatos');
    Route::post('/candidatos/update/{id}', [App\Http\Controllers\CandidatosController::class, 'update'])->name('candidatos');
    Route::delete('/candidatos/delete/{id}', [App\Http\Controllers\CandidatosController::class, 'delete'])->name('candidatos');
    Route::get('candidatos/data', 'CandidatoController@getCandidatosData')->name('candidatos');
});



