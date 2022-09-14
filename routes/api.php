<?php

use App\Http\Controllers\API\PartOne\indexController;
use App\Http\Controllers\API\PartTwo\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/skip_number_five', [indexController::class, 'skipNumberFive']);
Route::get('/getIndexOfString', [indexController::class, 'getIndexOfString']);
Route::post('/minimumStepsToZero', [indexController::class, 'minimumStepsToZero']);
Route::post('/login', [UserAPIController::class, 'login']);
Route::post('/register', [UserAPIController::class, 'store']);
Route::resource('/users', 'API\PartTwo\UserAPIController');
