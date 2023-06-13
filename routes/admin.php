<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Livewire\Admin\ShowCategory;

use App\Http\Livewire\Admin\BrandComponent;

use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\TownComponent;
use App\Http\Livewire\Admin\UserComponent;


Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('invoices', [InvoiceController::class, 'index'])->name('admin.invoices.index');
Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('admin.invoices.show');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');

Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');

Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');

Route::get('towns/{town}', TownComponent::class)->name('admin.towns.show');

Route::get('users', UserComponent::class)->name('admin.users.index');