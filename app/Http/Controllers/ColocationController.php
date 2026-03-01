<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Models\Colocation;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ColocationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $colocation = $user->colocations()
            ->wherePivot('left_at', null)
            ->with('owner')
            ->first();
        return view('dashboard', [
            'colocation' => $colocation
        ]);
    }
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
    public function destroy(Colocation $colocation)
    {
        $colocation->delete();
        return redirect()->route('dashboard');
    }
    public function update(Colocation $colocation, Request $request)
    {;
        $colocation->name = $request->name;
        $colocation->save();
        return redirect()->route('dashboard')->with('status', 'Colocation infos a ete modifié avec succès !');
    }
    public function invite(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
        ]);
        $colocation = $request->user()->memberships()->whereNull('left_at')->first()->colocation;
        $token = Str::random(12);
        Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $validated['email'],
            'token' => $token,
        ]);

        Mail::to($validated['email'])->send(new InvitationMail($token, $colocation));
        return back()->with('status', 'Invitation envoyée !');
    }
    public function acceptInvite($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();
        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation ne vous est pas destinée.');
        }
        return view('invitations.accept', compact('invitation'));
    }
    public function join($token)
    {
        // 1. Find the invitation by token
        $invitation = Invitation::where('token', $token)->firstOrFail();

        // 2. Security: Ensure the person clicking is the person invited
        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'This invitation was not intended for this account.');
        }

        // 3. Attach the user to the colocation
        // Note: Use the relationship name defined in your Colocation model (usually 'users' or 'members')
        $invitation->colocation->members()->attach(Auth::id(), [
            'joined_at' => now(),
            // Add any pivot columns like 'role' => 'member' here if needed
        ]);

        // 4. Delete the invitation so it cannot be used again
        $invitation->delete();

        // 5. Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('status', 'Welcome to the colocation!');
    }
}
