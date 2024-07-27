<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AuthorsController;



/*
    API Versioning
*/

Route::middleware("auth:sanctum")->group(function () {
    Route::get('/', [StatusController::class, 'index']);
});

Route::prefix('v1')->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::apiResource('/authors', AuthorsController::class);
    });
});



Route::fallback(function () {
    return response()->json([
        'message' => 'Route not found'
    ], 404);
});
