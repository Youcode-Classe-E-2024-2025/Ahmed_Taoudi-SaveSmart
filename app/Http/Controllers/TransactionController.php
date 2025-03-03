<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::find(session('current_profile_id')); // session('current_profile');
        return view('dashboard.transactions', compact('profile'));
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
            'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:expense,income'],
            'amount' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
        $validated['profile_id'] =  session('current_profile_id');
        // dd($validated);
        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaction ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($transaction)
    {
        $transaction = Transaction::findOrFail($transaction);

        return response()->json($transaction);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $transaction)
    {

        $request->validate([
            'transaction_date' => 'required|date',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:expense,income',
            'category_id' => 'required|exists:categories,id',
        ]);

        $transaction = Transaction::findOrFail($transaction);

        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('transactions.index')->with('success','Transaction modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    { 
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success','Transaction supprimé avec succès !');
    }
}
