<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    return
        [ Route::post('/user/register', [\App\Http\Controllers\UserController::class, 'registerSlUser']),
          Route::post('/register', 'Auth\RegisterController@register')
        ];

});


Route::resource('quizzes', App\Http\Controllers\API\QuizAPIController::class);


Route::resource('sl_objects', App\Http\Controllers\API\SlObjectAPIController::class);
