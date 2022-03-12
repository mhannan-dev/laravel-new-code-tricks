<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Reports\InvoiceReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', 'invoices');

// "Old" routes - before refactoring for Single Responsibility Principle
Route::get('invoices/report_month', [InvoiceController::class, 'reportByMonth'])->name('invoices.report_month');
Route::get('invoices/report_product', [InvoiceController::class, 'reportByProduct'])->name('invoices.report_product');
// "New" Better routes for reports - with SOLID principle
Route::get('reports/invoices/month/{format?}', [InvoiceReportController::class, 'reportByMonth'])->name('reports.invoices.month');
Route::get('reports/invoices/product/{format?}', [InvoiceReportController::class, 'reportByProduct'])->name('reports.invoices.product');
Route::resource('invoices', InvoiceController::class)->only('index', 'create', 'store');
