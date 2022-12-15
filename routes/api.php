<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\DamageController;
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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::prefix('V1')->middleware('auth:sanctum')->group( function (){ // Version #1 api list

    Route::prefix('customer')->group( function (){
        Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
    });
    Route::prefix('damages')->group( function (){
        Route::get('/', [DamageController::class, 'index'])->name('damage.list');
        Route::post('/', [DamageController::class, 'store'])->name('damage.store');
        Route::get('/customer/{customer_reference}', [DamageController::class, 'customersList'])->name('damage.customer.list');
        Route::get('/{id}', [DamageController::class, 'show'])->name('damage.show');
        Route::put('/{id}', [DamageController::class, 'update'])->name('damage.update');
    });
});


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
