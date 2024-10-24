<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AgentController;
use App\Http\Controllers\API\EquipementController;
use App\Http\Controllers\API\SiteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('agents', AgentController::class);
    Route::get('agents/search', [AgentController::class, 'search']);
    Route::apiResource('equipements', EquipementController::class);
    Route::get('equipements/search', [EquipementController::class, 'search']);
    Route::apiResource('sites', SiteController::class); 
    Route::get('sites/search', [SiteController::class, 'search']);
});
