<?php

use App\Http\Controllers\PokemonController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');
Route::get('/pokemons/{id}', [PokemonController::class, 'show'])->name('pokemons.show');
Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
Route::put('/pokemons/{id}', [PokemonController::class, 'update'])->name('pokemons.update');
Route::delete('/pokemons/{id}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');