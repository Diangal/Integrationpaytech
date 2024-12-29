<?php

use Illuminate\Support\Facades\Route;
use app\Http\controllers\ProductControllers;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/paiement',[ProductController::class, 'store'])->name('paiement');
Route::get('/success',[ProductController::class, 'success'])->name('success');
Route::get('/cancel',[ProductController::class, 'cancel'])->name('cancel');