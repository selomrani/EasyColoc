<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Mail\MytestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    $users = User::where('role_id','=','2')->get();
    $usersCount = User::where('role_id','=','2')->count();
    return view('admin.dashboard', compact('users','usersCount'));
})->middleware(['auth', 'verified', 'permission', 'ban'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/admin', [AdminController::class, 'index'])
//     ->middleware(['auth', 'permission', 'ban'])
//     ->name('admin.dashboard');
require __DIR__ . '/auth.php';
Route::get('/email', function () {
    // $token = Auth::user()->first_name;
    $token = Str::random(10);
    Mail::to('elomranisoufyan@gmail.com')->send(new MytestEmail($token));
    return 'Email Sent';
});
Route::view('/banned', 'errors.banned');
Route::patch('/users/{user}/ban', [AdminController::class, 'ban'])
    ->name('users.ban');
