<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\VendorLedgerController;
use App\Http\Controllers\CustomerLedgerController;

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

Route::get('/get-pdf/{id}', [InvoicesController::class, 'pdfview'])->name('get-pdf');
Route::get('get-customer-ledger/{id}', [CustomerLedgerController::class, 'ledgerPDF'])->name('ledgercustomer');
Route::get('get-vendor-ledger/{id}', [VendorLedgerController::class, 'ledgerPDF'])->name('ledgervendor');