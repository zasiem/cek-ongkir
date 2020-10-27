<?php

use App\Http\Controllers\OngkirController;
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

Route::get('/', [OngkirController::class, 'index']);
Route::post('/get-cities', [OngkirController::class, 'getCities']);
Route::post('/process', [OngkirController::class, 'cekOngkir']);
