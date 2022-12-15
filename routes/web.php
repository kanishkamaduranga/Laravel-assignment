<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\RepairShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('web.post.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('web.logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/damage/{id}', [DashboardController::class, 'show'])->name('dashboard.damage.show');
    Route::patch('/damage/{id}', [DashboardController::class, 'updateStatus'])->name('dashboard.damage.status_update');

    Route::resource('repair-shop', RepairShopController::class);

});

