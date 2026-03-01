<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use App\Mail\MytestEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/','welcome')->name('home.after403');
Route::get('/admin', function () {
    $users = User::where('role_id','=','2')->get();
    $banned = User::where('is_active','=','false')->count();
    $usersCount = User::where('role_id','=','2')->count();
    return view('admin.dashboard', compact('users','usersCount','banned'));
})->middleware(['auth', 'verified', 'permission', 'ban'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', [ColocationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
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
Route::middleware('auth')->group(function () {
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
});
Route::post('/colocations/{colocation}/invite', [ColocationController::class, 'invite'])->name('colocations.invite');
Route::delete('colocations/{colocation}', [ColocationController::class,'destroy'])->name('colocations.cancel');