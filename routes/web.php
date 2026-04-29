<?php

use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('url', 'manage-url')->name('url')->middleware('has.company');
    Route::view('invite', 'invite')->name('invite')->middleware('has.company');
});

Route::get('{short_code}', ShortUrlController::class);