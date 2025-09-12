<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [MemberController::class, 'showRegistrationForm'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Public member registration routes
Route::prefix('member')->group(function () {
    Route::get('/register', [MemberController::class, 'showRegistrationForm'])->name('member.registration.form');
    Route::post('/register', [MemberController::class, 'register'])
        ->middleware('throttle:5,1') // 5 attempts per minute
        ->name('member.register');
});

// Protected Admin routes
Route::prefix('admin')->middleware(['auth', 'admin', 'throttle:60,1'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.members');
    })->name('admin.dashboard');
    
    // Member management routes
    Route::prefix('members')->group(function () {
        // View members
        Route::get('/', [MemberController::class, 'index'])->name('admin.members.index');
        Route::get('/statistics', [MemberController::class, 'statistics'])->name('admin.members.statistics');
        
        // Status management
        Route::patch('/{member}/status', [MemberController::class, 'updateStatus'])->name('admin.members.status');
        
        // Soft delete management
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('admin.members.archive');
        Route::post('/{id}/restore', [MemberController::class, 'restore'])->name('admin.members.restore');
        Route::delete('/{id}/force', [MemberController::class, 'forceDestroy'])->name('admin.members.force.delete');
        
        // Database management routes
        Route::post('/reset-increment', [MemberController::class, 'resetAutoIncrement'])->name('admin.members.reset.increment');
        Route::delete('/clear-all', [MemberController::class, 'clearAllData'])->name('admin.members.clear.all');
    });
});