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

// 📌 Tableau de bord principal selon rôle
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion utilisateurs (admin uniquement)
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/dashboard/export/pdf', [DashboardController::class,'exportPdf'])->name('dashboard.export.pdf');
        Route::get('/dashboard/export/excel', [DashboardController::class,'exportExcel'])->name('dashboard.export.excel');
    });

    // Autres resources protégées
    Route::resource('dossiers', DossierController::class);

    Route::get('/audiences/calendar', [AudienceController::class, 'calendar'])->name('audiences.calendar');
    Route::get('/audiences/export/pdf', [AudienceController::class, 'exportPdf'])->name('audiences.export.pdf');
    Route::get('/audiences/export/excel', [AudienceController::class, 'exportExcel'])->name('audiences.export.excel');
    Route::resource('audiences', AudienceController::class);

    Route::resource('courriers', CourrierController::class);
});

require __DIR__.'/auth.php';
