<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TagController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{id}', [TagController::class, 'show']);
Route::post('/tags', [TagController::class, 'store']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);
