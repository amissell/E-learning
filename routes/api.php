<?php

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrollmentController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




Route::get('/', function()
{
  return 'API';
});
Route::apiResource('/tags',TagController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/refresh', [AuthController::class, 'refreshToken']);
// Route::get('/user-details', [AuthController::class, 'getDetailsUsers'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin', function () {
  return response()->json(['message' => 'Welcome, Admin!']);
});


Route::middleware('auth:sanctum')->group(function () {
  Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'enroll']);
  Route::get('/courses/{id}/enrollments', [EnrollmentController::class, 'listEnrollments'])->middleware('role:admin|mentor');
  Route::put('/enrollments/{id}', [EnrollmentController::class, 'updateEnrollment'])->middleware('role:admin|mentor');
  Route::delete('/enrollments/{id}', [EnrollmentController::class, 'deleteEnrollment'])->middleware('role:admin|mentor');
});

