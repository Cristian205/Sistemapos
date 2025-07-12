<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowViewsController;


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
    return view('Login.Views-login');
})->name('Login');

Route::get('login', [ShowViewsController::class, 'ShowViewLogin'])->name('LoginViews');
Route::post('/login', [LoginController::class, 'LoginUser'])
    ->name('login.usuarios');
Route::post('/register', [LoginController::class, 'RegisterUser'])->name('Register');


Route::get('Dashboard', [ShowViewsController::class, 'ShowViewDashboard'])->middleware('auth')->name('DashboardViews');


