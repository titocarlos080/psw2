<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;



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
Route::post('/admin/login',[ApiController::class,'login'])->name('loginapp.index');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/citas/cliente/{id}',[ApiController::class,'citas'])->name('citas.getcitasClient');
Route::get('/admin/diagnosticos/cliente/{id}',[ApiController::class,'diagnosticos'])->name('diagnosticos.getClient');

Route::get('/admin/recomendaciones/cliente/{id}',[ApiController::class,'recomendaciones'])->name('recomendaciones.getClient');
