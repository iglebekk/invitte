<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AccessController;
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

Route::get('/', function () {
    return view('index');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/password/{token}', [AuthController::class, 'password'])->name('password');
Route::post('/password/{token}', [AuthController::class, 'addPassword'])->name('password');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');

    Route::post('/events', [EventController::class, 'create'])->name('events');
    Route::get('/events/{event}', [EventController::class, 'view'])->name('event');

    Route::post('/events/{event}/guests', [GuestController::class, 'create'])->name('guests');
    Route::post('/evetns/{event}/guests/mass', [GuestController::class, 'massCreate'])->name('guests.mass');

    Route::get('/events/{event}/accesses', [AccessController::class, 'view'])->name('accesses');
    Route::post('/events/{event}/accesses', [AccessController::class, 'store'])->name('accesses');
});
