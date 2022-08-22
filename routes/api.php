<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MainController;
use App\Http\Controllers\API\GoalController;
use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\ReviewnController;
use App\Http\Controllers\API\QuestionController;


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


Route::get('/main',[MainController::class,'index']);
Route::get('/main/edit',[MainController::class,'edit']);
Route::post('/main/update/{id}',[MainController::class,'update']);

Route::resource('goals',GoalController::class);

Route::resource('features',FeatureController::class);

Route::resource('reviews',ReviewnController::class);

Route::resource('questions',QuestionController::class);
