<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowViewsController;
use App\Http\Controllers\CategoriaNegocioController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\FunctionsController;
use Inertia\Inertia;


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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('layouts.Welcome_Pos');
})->name('welcome');

Route::get('login', [ShowViewsController::class, 'ShowViewLogin'])->name('LoginViews');
Route::post('/login', [LoginController::class, 'LoginUser'])
    ->name('login.usuarios');
Route::post('/register', [LoginController::class, 'RegisterUser'])->name('Register');

Route::get('/registro', function () {
    return view('registro'); // esta vista contendrá tu <div id="app"></div>
})->name('registro');

Route::get('/api/planes', [PlanesController::class, 'index']);

Route::get('/categorias-negocio', [CategoriaNegocioController::class, 'index']);

Route::post('/registro', [FunctionsController::class, 'RegistroPasoAPaso']);


Route::get('Dashboard', [ShowViewsController::class, 'ShowViewDashboard'])->middleware('auth')->name('DashboardViews');


