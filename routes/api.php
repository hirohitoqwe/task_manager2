<?php


use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\LabelController;
use \App\Http\Controllers\Api\AssignController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\AuthController;

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

Route::post('/user/registration', [RegisterController::class, 'register']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['prefix' => '/task'], function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/{id}', [TaskController::class, 'getById']);
    Route::post('/create', [TaskController::class, 'create']);
    Route::delete('/{id}', [TaskController::class, 'delete']);
});

Route::group(['prefix' => '/label'], function () {
    Route::post('/create', [LabelController::class, 'create']);
    Route::delete('/{id}', [LabelController::class, 'delete']);
});

Route::post('/assign/{labelId}/{taskId}', [AssignController::class, 'assignLabelToTask']);
