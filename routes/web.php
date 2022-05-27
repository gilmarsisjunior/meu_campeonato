<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Match\MatchController;
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

Route::get('/', [TeamController::class, 'index']);
Route::post('/create', [TeamController::class, 'create'])->name('teams.create');
Route::get('/campeonato', [TeamController::class, 'show']);