<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\LedgerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/get-pdf/{saleID}', [InvoicesController::class, 'pdfview'])->name('get-pdf');
Route::get('get-ledger/{customer_id}', [LedgerController::class, 'ledgerView']);