<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\DishTypeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::middleware(('auth:sanctum'))->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::resource('/accounts', AccountController::class)->except(['create', 'edit']);
Route::put('/accounts/{id}/role', [AccountController::class, 'updateRole']);
Route::resource('/dish-types', DishTypeController::class)->except(['create', 'edit']);
Route::prefix('/dishes')->group(function () {
    Route::get('/', [DishController::class, 'index']);
    Route::post('/', [DishController::class, 'store']);
    Route::get('/{id}', [DishController::class, 'show']);
    Route::post('/{id}', [DishController::class, 'update']);
    Route::delete('/{id}', [DishController::class, 'destroy']);
});
Route::resource('/tables', TableController::class)->except(['create', 'edit']);
Route::resource('/orders', OrderController::class)->except(['create', 'edit']);
Route::resource('/bills', BillController::class)->except(['create', 'edit']);
Route::prefix('/ingredients')->group(function () {
    Route::get('/', [IngredientController::class, 'index']);
    Route::post('/', [IngredientController::class, 'store']);
    Route::get('/{id}', [IngredientController::class, 'show']);
    Route::post('/{id}', [IngredientController::class, 'update']);
    Route::delete('/{id}', [IngredientController::class, 'destroy']);
});
Route::get('/revenue', [RevenueController::class, 'revenueByDate']);
