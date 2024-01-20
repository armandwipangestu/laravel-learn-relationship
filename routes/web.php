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

Route::get('/relation/test', [RelationController::class, 'test']);
Route::get('/relation/one-to-one', [RelationController::class, 'oneToOne']);
Route::get('/relation/one-to-many', [RelationController::class, 'oneToMany']);
Route::get('/relation/default-model', [RelationController::class, 'defaultModel']);
Route::get('/relation/where-belongs-to', [RelationController::class, 'whereBelongsTo']);
Route::get('/relation/has-one-of-many', [RelationController::class, 'hasOneOfMany']);
Route::get('/relation/advance-has-one-of-many', [RelationController::class, 'advanceHasOneOfMany']);
Route::get('/relation/has-one-through', [RelationController::class, 'hasOneThrough']);
Route::get('/relation/has-many-through', [RelationController::class, 'hasManyThrough']);
Route::get('/relation/belongs-to-many', [RelationController::class, 'belongsToMany']);
Route::get('/relation/invers-belongs-to-many', [RelationController::class, 'inversBelongsToMany']);
Route::get('/relation/retrieving-intermediate-model', [RelationController::class, 'retrievingIntermediateModel']);
Route::get('/relation/customizing-pivot-attribute-name', [RelationController::class, 'customizingPivotAttributeName']);
