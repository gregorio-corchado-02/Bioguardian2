<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Models\User;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    
    
    
});

Route::post('/guardarpublicacion', [PublicacionController::class, 'guardarPublicacion']);

Route::get('/publicar', [PublicacionController::class, 'create'])->name('crear.publicacion');

Route::post('/perfil/update', [ProfileController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{id}', [ProfileController::class, 'destroy'])->name('perfil.destroy');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::post('/editpublicar/{id}', [PublicacionController::class, 'update'])->name('edit.publicacion');

Route::post('/elimpublicar/{id}', [PublicacionController::class, 'eliminarpublicacion'])->name('elim.publicacion');
