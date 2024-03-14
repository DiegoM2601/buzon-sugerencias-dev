<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


Route::middleware(['check-ip'])->group(function () {
    Route::get('/cochabamba', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
    Route::get('/el-alto', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
    Route::get('/la-paz', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
    Route::get('/santa-cruz', [App\Http\Controllers\SuggestionsController::class, 'index'])->name('index');
});

Auth::routes();

Route::post('suggestion-store', [App\Http\Controllers\SuggestionsController::class, 'store'])->name('store');
Route::resource('areas', App\Http\Controllers\AreasController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/export', [App\Http\Controllers\HomeController::class, 'export'])->name('export');
Route::get('/area', [App\Http\Controllers\HomeController::class, 'area'])->name('area');

Route::get('/acceso-restringido', function () {
    return view('acceso-restringido');
});

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::post('/update-suggestion', [App\Http\Controllers\HomeController::class, 'updateSuggestion'])->name("updateSuggestion");

Route::post('/search-parameters', [App\Http\Controllers\HomeController::class, 'searchParameters']);

Route::get('/registro', function () {
    return view('auth.register');
});