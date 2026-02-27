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
    $banned = User::where('is_active','=','false')->count();
    $usersCount = User::where('role_id','=','2')->count();
    return view('admin.dashboard', compact('users','usersCount','banned'));
})->middleware(['auth', 'verified', 'permission', 'ban'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::view('dashboard','dashboard');
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
