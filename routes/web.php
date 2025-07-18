<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\NotificationsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login')
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')
->prefix('users')
->name('users.')
->group(function () {
    Route::get('/all', [UserController::class, 'index'])->name('all');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});

Route::middleware('auth')
    ->prefix('role-permission')
    ->name('role-permission.')
    ->group(function () {
        Route::get('/roles', [RolePermissionController::class, 'roles'])->name('roles');
        Route::get('/assign', [RolePermissionController::class, 'assign'])->name('assign');
        // Add other routes as needed
    });

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings.index');
});

require __DIR__.'/auth.php';