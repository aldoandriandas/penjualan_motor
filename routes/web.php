<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\MerkController;
use App\Http\Controllers\Admin\ModelMotorController;
use App\Http\Controllers\Admin\MotorController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.proses');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProses'])->name('register.proses');

Route::get('/verifyAccount/{token}', [AuthController::class, 'verifyAccount'])->name('auth.verifyAccount');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/myprofile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/myprofile/update', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| PUBLIC MOTOR
|--------------------------------------------------------------------------
*/

Route::get('/motors', [MotorController::class, 'index'])->name('motors.index');
Route::get('/motors/{motor}', [MotorController::class, 'show'])->name('motors.show');
Route::get('/produk', [MotorController::class, 'produk'])->name('motors.produk');
Route::get('/search-motor', [MotorController::class, 'search'])->name('motors.search');
Route::get('/searchs-motor', [MotorController::class, 'searchs'])->name('motor.searchs');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| ADMIN & SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CONTACT
        Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contacts.reply');

        // TRANSACTIONS
        Route::resource('transaction', TransactionController::class)->except(['edit', 'update']);
        Route::post('/transaction/status/{id}', [TransactionController::class, 'updateStatus'])->name('transaction.status');

        // MOTOR
        Route::resource('motor', MotorController::class);

        // MERK & MODEL
        Route::resource('merk', MerkController::class);
        Route::resource('model', ModelMotorController::class);

        // DEALER & USER
        Route::resource('dealer', DealerController::class);
        Route::resource('user', UserController::class);
    });

/*
|--------------------------------------------------------------------------
| SALES
|--------------------------------------------------------------------------
*/

Route::prefix('sales')
    ->middleware(['auth', 'role:sales'])
    ->name('sales.')
    ->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
    });