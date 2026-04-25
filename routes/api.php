<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\GenreController;


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

// Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/index', [AuthorController::class, 'index']);
Route::post('/authors/store', [AuthorController::class, 'store']);
Route::patch('/authors/update',[AuthorController::class, 'update']);
Route::delete('/authors/destroy',[AuthorController::class, 'destroy']);

Route::resource('genres',GenreController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
