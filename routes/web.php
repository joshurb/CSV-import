<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampersController;

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

Route::get('/', [CampersController::class, 'index'])->name('home');
Route::post('/upload', [CampersController::class, 'importCSV'])->name('importCSV');
