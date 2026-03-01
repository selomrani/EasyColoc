<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $hasActiveColocation = $user->colocations()->wherePivot('left_at', null)->exists();
        if ($hasActiveColocation) {
            return back()->withErrors(['alreadyIn' => 'Vous appartenez déjà à une colocation active.']);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $colocation = Colocation::create([
            'name' => $validated['name'],
            'status' => 'active',
            'created_by' => $user->id
        ]);
        $colocation->members()->attach($user->id, [
            'joined_at' => now(),
        ]);
        return redirect()->route('dashboard')->with('status', 'Colocation créée avec succès !');
    }
}
