<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Tutte le rotte API per i progetti
// Route::apiResource('projects', ProjectController::class);

// Rotta API per il metodo index
Route::get('/projects', [ProjectController::class, 'index']);

// Rotta per il dettaglio del singolo Progetto
Route::get('/projects/{project}', [ProjectController::class, 'show']);

// Rotta per i progetti raggruppati per tipo, prendo l'id del progetto che appartiene a quel tipo
Route::get('/types/{id}/projects', [ProjectController::class, 'typeProjectsIndex']);
