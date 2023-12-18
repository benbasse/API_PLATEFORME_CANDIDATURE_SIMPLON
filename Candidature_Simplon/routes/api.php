<?php

use App\Http\Controllers\Api\CandidatController;
use App\Http\Controllers\Api\FormationController;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// The routes of candidats
Route::post('registerCandidat', [CandidatController::class, 'registerCandidat']);
Route::post('loginCandidat', [CandidatController::class, 'login']);

//Les routes pour les formations
Route::get('formations/liste', [FormationController::class, 'index']);
Route::post('formations/store', [FormationController::class, 'store']);
Route::put('formations/edit/{id}', [FormationController::class, 'update']);
Route::delete('formations/{formation}', [FormationController::class, 'destroy']);
