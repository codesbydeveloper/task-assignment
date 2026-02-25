<?php

use App\Livewire\Admin\CronLogViewer;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\QueueStatus;
use App\Livewire\Admin\SystemHealth;
use App\Livewire\Admin\UsersTable;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;
use App\Livewire\User\ActivityLog;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\NotificationsList;
use App\Livewire\User\ProfileForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', LoginForm::class)->name('home');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginForm::class)->name('login');
    Route::get('/register', RegisterForm::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/profile', ProfileForm::class)->name('profile');
    Route::get('/notifications', NotificationsList::class)->name('notifications');
    Route::get('/activity', ActivityLog::class)->name('activity');

    Route::middleware(['role:admin', 'admin.ip'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/users', UsersTable::class)->name('users');
        Route::get('/cron-logs', CronLogViewer::class)->name('cron_logs');
        Route::get('/queue', QueueStatus::class)->name('queue');
        Route::get('/health', SystemHealth::class)->name('health');
    });
});
