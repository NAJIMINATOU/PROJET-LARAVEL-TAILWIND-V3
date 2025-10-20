<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return view('dashboards.admin');
    } elseif ($user->role === 'juge') {
        return view('dashboards.juge');
    } elseif ($user->role === 'greffier') {
        return view('dashboards.greffier');
    }

    return view('dashboard'); // fallback si un autre rôle
})->middleware(['auth'])->name('dashboard');
// Dashboard Admin
Route::get('/admin', function () {
    return view('dashboards.admin');
})->middleware(['auth'])->name('admin.dashboard');
// web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Dashboard Juge
Route::get('/juge', function () {
    return view('dashboards.juge');
})->middleware(['auth'])->name('juge.dashboard');

// Dashboard Greffier
Route::get('/greffier', function () {
    return view('dashboards.greffier');
})->middleware(['auth'])->name('greffier.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('dossiers', DossierController::class);
    // ✅ Route du calendrier avant le resource
    Route::get('/audiences/calendar', [AudienceController::class, 'calendar'])
        ->name('audiences.calendar');
        Route::get('/audiences/export/pdf', [AudienceController::class, 'exportPdf'])->name('audiences.export.pdf');
Route::get('/audiences/export/excel', [AudienceController::class, 'exportExcel'])->name('audiences.export.excel');

    Route::resource('audiences', AudienceController::class);
    Route::resource('courriers', CourrierController::class);
  
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


require __DIR__.'/auth.php';
