<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\Mutate\Mutators\Sets\ReturnSet;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $colocation = $user->colocations()
            ->wherePivot('left_at', null)
            ->first();
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'amount' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'] 
        ]);
        $colocation->expenses()->create([
            'name'        => $validated['name'],
            'amount'      => $validated['amount'],
            'category_id' => $validated['category_id'],
            'user_id'     => $user->id,
        ]);
        return back()->with('status', value: 'dépense a éte crée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
