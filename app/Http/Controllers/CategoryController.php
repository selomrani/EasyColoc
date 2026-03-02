<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Colocation $colocation)
    {
        $user = Auth::user();
        $colocation = $user->colocations()
            ->wherePivot('left_at', null)
            ->with('owner')
            ->first();
        $categories = $colocation->categories()->get;
        return view('dashboard', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request, Colocation $colocation)
    {
        $user = Auth::user();
        $colocation = $user->colocations()
            ->wherePivot('left_at', null)
            ->first();
        $validated = $request->validate(['name' => ['required', 'max:255']]);
        $colocation->categories()->create($validated);
        return back()->with('status', value: 'categorie a éte crée !');
    }
    


    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('dashboard')->with('status', 'categorie modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Colocation $colocation)
    {
        $category->delete();
        return redirect()->route('dashboard')->with('status', 'Catégorie supprimée !');
    }
}
