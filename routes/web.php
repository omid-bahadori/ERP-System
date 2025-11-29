<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $customersCount = \App\Models\Customer::where('is_active', true)->count();
    $productsCount = \App\Models\Product::where('is_active', true)->count();
    $invoicesCount = \App\Models\Invoice::count();
    $totalRevenue = \App\Models\Invoice::where('status', 'paid')->sum('total');
    $pendingInvoices = \App\Models\Invoice::whereIn('status', ['draft', 'sent'])->count();
    $recentInvoices = \App\Models\Invoice::with('customer')->latest()->take(5)->get();
    $lowStockProducts = \App\Models\Product::where('stock', '<', 10)->where('is_active', true)->count();
    
    $monthlyRevenue = \App\Models\Invoice::where('status', 'paid')
        ->whereYear('invoice_date', now()->year)
        ->whereMonth('invoice_date', now()->month)
        ->sum('total');
    
    return view('dashboard', compact(
        'customersCount', 
        'productsCount', 
        'invoicesCount', 
        'totalRevenue', 
        'pendingInvoices',
        'recentInvoices',
        'lowStockProducts',
        'monthlyRevenue'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);
});

Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

require __DIR__.'/auth.php';
