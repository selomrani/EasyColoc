<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.dashboard', compact('users'));
    }
    public function ban(User $user){
        if($user->is_active == true){
            $user->is_active = false;
        }
        else{
            $user->is_active = true;
        }
        $user->update();
        return back();
    }
}
