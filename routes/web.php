<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;  // Pastikan ini ada


// Halaman beranda publik
Route::get('/', function () {
    return view('home'); // resources/views/home.blade.php
});

// Redirect setelah login berdasarkan role
Route::get('/redirect-after-login', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'user'  => redirect()->route('user.dashboard'),
        default => abort(403),
    };
})->middleware(['auth']);

// Dashboard default Breeze (opsional)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (semua user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup route khusus admin
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin.index'))->name('dashboard');

    // Layanan
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Rute lainnya...
    Route::get('/orders', fn() => view('dashboard.admin.orders.index'))->name('orders.index');
    Route::get('/users', fn() => view('dashboard.admin.users.index'))->name('users.index');
    Route::get('/categories', fn() => view('dashboard.admin.categories.index'))->name('categories.index');
    Route::get('/faqs', fn() => view('dashboard.admin.faqs.index'))->name('faqs.index');
    Route::get('/testimonials', fn() => view('dashboard.admin.testimonials.index'))->name('testimonials.index');
    Route::get('/settings', fn() => view('dashboard.admin.settings.index'))->name('settings.index');
    Route::get('/contact-messages', fn() => view('dashboard.admin.contact_messages.index'))->name('contact_messages.index');
});

// Grup route khusus user
Route::middleware(['auth', 'is_user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.user.index'))->name('dashboard');
    Route::get('/orders', fn() => view('dashboard.user.orders'))->name('orders');
    Route::get('/form-pemesanan', fn() => view('dashboard.user.form_pemesanan'))->name('form_pemesanan');
});

// Route auth dari Breeze
require __DIR__.'/auth.php';
