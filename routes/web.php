<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\ReviewController;

use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateInvoice;

use App\Http\Livewire\PaymentInvoice;



use App\Models\Invoice;

Route::get('/', WelcomeController::class);

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::match(['get', 'post'], 'reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');

Route::middleware(['auth'])->group(function(){

    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');

    Route::get('invoices/create', CreateInvoice::class)->name('invoices.create');

    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

    Route::get('invoices/{invoice}/payment', PaymentInvoice::class)->name('invoices.payment');

    Route::get('invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay');

    Route::post('webhooks', WebhooksController::class);

});