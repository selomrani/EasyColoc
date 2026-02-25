<?php

use App\Http\Controllers\ProfileController;
use App\Mail\MytestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','routing'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::view('/admin', 'admin.dashboard');
require __DIR__ . '/auth.php';

Route::get('/testroute', function() {
    Mail::to('elomranisoufyan@gmail.com')->send(new MytestEmail());
    return 'Email Sent';
});
