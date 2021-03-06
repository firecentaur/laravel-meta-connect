<?php

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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('quizzes', App\Http\Controllers\QuizController::class);


Route::resource('slObjects', App\Http\Controllers\SlObjectController::class);


Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('questions', App\Http\Controllers\QuestionController::class);


Route::resource('userModels', App\Http\Controllers\UserModelController::class);
