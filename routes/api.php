<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['force.json.response', 'api', 'rbac', 'spatie.role.permission'])->prefix('/application-name')->group( function () {
    // TODO(): All Resource Routes Paste or Write
});


Route::middleware(['force.json.response', 'api', 'rbac', 'spatie.role.permission'])->prefix('/application-admin-name')->group( function () {
    // TODO(): All Resource Admin Routes Paste or Write
});


Route::prefix('/postman')->group( function () {
    // TODO(): All Route For Postman API Testing Paste or Wrote
});
