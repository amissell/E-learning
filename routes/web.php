<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;


use App\Http\Controllers\CourseController;
use App\Http\Controllers\RolePermissionController;




Route::get('/', function () {
    return view('welcome');
});


Route::get('/create-roles-permissions', [RolePermissionController::class, 'createRolesAndPermissions']);

