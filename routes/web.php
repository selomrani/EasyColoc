<?php

use App\Http\Controllers\ProfileController;
use App\Mail\MytestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','permission'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::view('/admin', 'admin.dashboard')->middleware('permission');
require __DIR__ . '/auth.php';

Route::get('/email', function() {
    // $token = Auth::user()->first_name;
    $token = Str::random(10);
    Mail::to('elomranisoufyan@gmail.com')->send(new MytestEmail($token));
    return 'Email Sent';
});
