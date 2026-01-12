<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LoginHistoryController;

Route::prefix('admin')->name('admin.')->group(function() {
    // Login History page
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login-history');
});
