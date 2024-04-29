<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UtilisateurController;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user_', [AuthController::class, 'user']);
    Route::post('/logout_', [AuthController::class, 'logout']);
});

// Dans routes/api.php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/projets', [ProjetController::class, 'index']);
Route::get('/projets/user/{userId}', [ProjetController::class, 'getProjectsByUserId']);


// routes pour CRUD Utilisateurs

Route::post('/userProject/{projectId}/user/{userId}', [UtilisateurController::class, 'storeUser']);
Route::get('/users', [UtilisateurController::class, 'index']); // Get all users data √
Route::get('/users/{projectId}', [UtilisateurController::class, 'users']);
Route::post('/users', [UtilisateurController::class, 'store']);
Route::get('/users/{userId}', [UtilisateurController::class, 'show']);
Route::put('/users/{userId}', [UtilisateurController::class, 'update']);
Route::put('/users/{userId}/block', [UtilisateurController::class, 'block']);
Route::put('/users/{userId}/unblock', [UtilisateurController::class, 'unblock']);
Route::delete('/users/{userId}', [UtilisateurController::class, 'destroy']);

Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs', [JobController::class, 'index']);
