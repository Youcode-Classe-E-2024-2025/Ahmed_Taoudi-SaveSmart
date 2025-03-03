<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Auth::user()->categories;
        
        return view('dashboard.categories',compact('categories'));
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
        $validated = $request->validate([
            'name' => ['required', 'string','max:255'],
         ]);
         $validated['user_id']=  Auth::user()->id;
        //  dd($validated);
         Category::create($validated);
         return redirect()->route('categories.index')->with('success', 'Category ajouté avec succès !');
    }

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
    public function edit($category)
    {
        $category = Category::findOrFail($category);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string','max:255'],
         ]);

         $category = Category::findOrfail($category);

         $category->update(['name'=>$validated['name']]);
         
         return redirect()->route('categories.index')->with('success', 'Category modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category supprimé avec succès !');
    }
}
