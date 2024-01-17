<?php

use App\Http\Controllers\RelationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/relation/one-to-one', [RelationController::class, 'oneToOne']);
Route::get('/relation/one-to-many', [RelationController::class, 'oneToMany']);
Route::get('/relation/default-model', [RelationController::class, 'defaultModel']);
Route::get('/relation/where-belongs-to', [RelationController::class, 'whereBelongsTo']);
