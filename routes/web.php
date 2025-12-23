<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\KostController;
use App\Http\Controllers\Admin\RentalExtensionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsPenghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\LandingController;
use App\Http\Controllers\Public\KostPublicController;
use App\Http\Controllers\Tenant\TenantComplaintController;
use App\Http\Controllers\Tenant\TenantDashboardController;
use App\Http\Controllers\Tenant\TenantRentalExtensionController;

// Tenant Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', IsPenghuni::class])->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/kost', KostController::class);
    Route::resource('/room', RoomController::class);
    Route::resource('/tenant', TenantController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/gallery', GalleryController::class);
    Route::resource('/account', AccountController::class);
    Route::get('/rental_extension', [RentalExtensionController::class, 'index'])->name('rental_extension.index');
    Route::get('/complaint', [ComplaintController::class, 'index'])->name('complaint.index');
    Route::get('/rental_extension/{rentalExtension}', [RentalExtensionController::class, 'show'])->name('rental_extension.show');
    Route::get('/complaint/{complaint}', [ComplaintController::class, 'show'])->name('complaint.show');
    Route::delete('/rental_extension/{rentalExtension}', [RentalExtensionController::class, 'destroy'])->name('rental_extension.destroy');
    Route::delete('/complaint/{complaint}', [ComplaintController::class, 'destroy'])->name('complaint.destroy');
    Route::put('/account/{account}/accept', [AccountController::class, 'accept'])->name('account.accept');
    Route::put('/account/{account}/reject', [AccountController::class, 'reject'])->name('account.reject');
    Route::put('/rental_extension/{rentalExtension}/accept', [RentalExtensionController::class, 'accept'])->name('rental_extension.accept');
    Route::put('/rental_extension/{rentalExtension}/reject', [RentalExtensionController::class, 'reject'])->name('rental_extension.reject');
    Route::put('/complaint/{complaint}/response', [ComplaintController::class, 'response'])->name('complaint.response');
});

// Tenant Routes
Route::prefix('tenant')->name('tenant.')->middleware(['auth', IsPenghuni::class])->group(function () {
    Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/rental_extension', TenantRentalExtensionController::class);
    Route::resource('/complaint', TenantComplaintController::class);
});

// Landing
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Detail kost (pakai ID; nanti bisa di-upgrade ke slug)
Route::get('/kos/{kost}', [KostPublicController::class, 'show'])->name('kost.show');
