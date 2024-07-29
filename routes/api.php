<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('services', ServiceController::class);

    Route::post('/customers/service', [CustomerController::class, 'attach']);
    Route::post('/services/service/detach', [CustomerController::class, 'detach']);

    Route::post('/services/customers', [ServiceController::class, 'customers']);

    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::post('/invoices/bulk', [InvoiceController::class, 'bulkStore']);

    Route::apiResource('roles', RoleController::class);
    Route::get('/permissions', [RoleController::class, 'permissions']);
});
