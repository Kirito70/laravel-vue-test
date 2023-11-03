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

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['auth:sanctum'])
    ->prefix('v1')
    ->group(function () {
        Route::apiResource('companies', \App\Http\Controllers\Api\V1\CompaniesController::class);
        Route::apiResource('employees', \App\Http\Controllers\Api\V1\EmployeesController::class);
    });

Route::prefix('v1')
    ->group(function () {
        require __DIR__.'/auth.php';
    });