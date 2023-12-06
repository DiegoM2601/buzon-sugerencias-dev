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


Route::get('/cochabamba', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
Route::get('/el-alto', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
Route::get('/la-paz', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
Route::get('/santa-cruz', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');

Route::post('suggestion-store', [App\Http\Controllers\SuggestionsController::class, 'store'])->name('store');
<<<<<<< HEAD
Route::resource('areas', App\Http\Controllers\AreasController::class);

=======
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
<<<<<<< HEAD
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/export', [App\Http\Controllers\HomeController::class, 'export'])->name('export');
Route::get('/area', [App\Http\Controllers\HomeController::class, 'area'])->name('area');
=======
Route::get('/export', [App\Http\Controllers\HomeController::class, 'export'])->name('export');
>>>>>>> 3377b0de0ed0ee5f2e66fa75a283794659d776df
