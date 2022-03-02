<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

// Route::resource('recipes', RecipeController::class);

Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');

Auth::routes();