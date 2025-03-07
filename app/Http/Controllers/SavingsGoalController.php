<?php

namespace App\Http\Controllers;

use App\Models\SavingsGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingsGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $goals = Auth::user()->savingsGoals;
        // dd($goals);
        return view('dashboard.goals',compact('goals'));
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
        //
        // dd($request);
        $validated = $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'target_amount'=> ['required', 'numeric', 'gt:0'],
            'deadline'=> ['nullable','date','after:today'] 
        ]);
        // dd($validated);
        $validated['user_id']= Auth::user()->id;
        SavingsGoal::create($validated);
        return redirect()->route('goals.index')->with('success','Objectif créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(SavingsGoal $savingsGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($savingsGoal)
    {
        $savingsGoal = SavingsGoal::findOrFail($savingsGoal);

        return response()->json($savingsGoal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $savingsGoal)
    {
        $validated = $request->validate([
            'title'=> ['required', 'string', 'max:255'],
            'target_amount'=> ['required', 'numeric', 'gt:0'],
            'current_amount'=> ['required', 'numeric'],
            'deadline'=> ['nullable','date','after:today'] 
        ]);
        $goal = SavingsGoal::findOrFail($savingsGoal);
        // dd($validated);
        $goal->update($validated);

        return redirect()->route('goals.index')->with('success','Objectif modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $savingsGoal)
    {
        $goal = SavingsGoal::findOrFail($savingsGoal);
        $goal->delete();
        return redirect()->route('goals.index')->with('success','Objectif supprimé avec succès !');
    }
}
