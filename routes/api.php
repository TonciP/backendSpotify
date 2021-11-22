<?php

use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\GeneroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/biblioteca/show/{id}",[BibliotecaController::class,'show'])->name('ver');
Route::get("/biblioteca/index",[BibliotecaController::class,'index'])->name('select all');
Route::post("/biblioteca/store",[BibliotecaController::class,'store'])->name('guardar');
Route::put("/biblioteca/update/{id}",[BibliotecaController::class,'update'])->name('guardar');
Route::post("/biblioteca/{id}/subirCancion",[BibliotecaController::class,'subirCancion'])->name('cancion');
Route::delete("/biblioteca/destroy/{id}",[BibliotecaController::class,'destroy'])->name('eliminar');
Route::get("/biblioteca/artista/{id}",[BibliotecaController::class,'showBibliotecaArtista'])->name('ver Artista');

Route::get("/artista/show/{id}",[ArtistaController::class,'show'])->name('ver');
Route::get("/artista/index",[ArtistaController::class,'index'])->name('select all');
Route::post("/artista/store",[ArtistaController::class,'store'])->name('guardar');
Route::put("/artista/update/{id}",[ArtistaController::class,'update'])->name('guardar');
Route::post("/artista/{id}/subirImagen",[ArtistaController::class,'subirImagenArtista'])->name('imagen artista');
Route::delete("/artista/destroy/{id}",[ArtistaController::class,'destroy'])->name('eliminar');
Route::get("/artista/genero/{id}",[ArtistaController::class,'showArtistaGenero'])->name('ver Artista');
Route::get("/biblioteca/artista/{id}",[ArtistaController::class,'showBibliotecaArtista'])->name('ver Artista');

Route::post("/directorio",[ArtistaController::class,'mostraArchivoPath'])->name('ver archivos');

Route::get("/genero/show/{id}",[GeneroController::class,'show'])->name('ver');
Route::get("/genero/index",[GeneroController::class,'index'])->name('select all');
Route::post("/genero/store",[GeneroController::class,'store'])->name('guardar');
Route::put("/genero/update/{id}",[GeneroController::class,'update'])->name('guardar');
Route::post("/genero/{id}/subirImagen",[GeneroController::class,'subirImagenGenero'])->name('imagen genero');
Route::delete("/genero/destroy/{id}",[GeneroController::class,'destroy'])->name('eliminar');
