<?php

use App\Http\Controllers\Access\ForgoutController;
use App\Http\Controllers\Access\LoginController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Data\ExcelController;
use App\Http\Controllers\Data\PdfController;
use App\Http\Controllers\Price\PriceController;
use App\Http\Controllers\Price\ProductController;
use App\Http\Controllers\User\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logon', [LoginController::class, 'logon'])->name('logon');

Route::get('/forgout-account/{code?}', [ForgoutController::class, 'forgoutAccount'])->name('forgout-account');
Route::post('/send-recovery', [ForgoutController::class, 'sendRecovery'])->name('send-recovery');
Route::post('/recovery-password', [ForgoutController::class, 'recoveryPassword'])->name('recovery-password');

Route::middleware(['auth'])->group(function () {

    Route::get('/app', [AppController::class, 'app'])->name('app');

    Route::get('/list-user/{role?}', [UserController::class, 'listUser'])->name('list-user');
    Route::post('/create-user', [UserController::class, 'createUser'])->name('create-user');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('update-user');
    Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('delete-user');

    Route::get('/list-product', [ProductController::class, 'products'])->name('list-product');
    Route::post('/create-product', [ProductController::class, 'createProduct'])->name('create-product');
    Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update-product');
    Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete-product');

    Route::get('/price', [PriceController::class, 'price'])->name('price');
    Route::post('/create-price', [PriceController::class, 'createPrice'])->name('create-price');
    Route::post('/update-price', [PriceController::class, 'updatePrice'])->name('update-price');
    Route::post('/delete-price', [PriceController::class, 'deletePrice'])->name('delete-price');

    Route::get('/price-excel', [ExcelController::class, 'priceExcel'])->name('price-excel');
    Route::get('/price-pdf', [PdfController::class, 'pricePdf'])->name('price-pdf');
    Route::get('/price-view-pdf', [PdfController::class, 'pricePdf'])->name('price-view-pdf');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});