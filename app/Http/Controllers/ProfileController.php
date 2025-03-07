<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{ 
    public function index()
    {
        $user = Auth::user();
        $profiles = $user->profiles; 
        return view('profiles.index', compact('profiles'));
    }

    // Afficher le formulaire 
    public function create()
    {
        return view('profiles.create');
    }

    // Enregistrer un nouveau profil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pin' => 'required|string|max:4|min:4',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = new Profile();
        $profile->user_id = Auth::id();
        $profile->name = $request->name;
        $profile->pin = $request->pin;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $avatarPath;
        }
// dd($profile);
        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'Profil créé avec succès !');
    }


    // affiche dashboard pour current user
    public function show(Profile $profile){
        session(['current_profile_id'=>$profile->id]);
        Carbon::setLocale('fr');
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $user = User::with(['profiles.transactions' => function($query) use ($currentMonthStart, $currentMonthEnd) {
            $query->whereBetween('transaction_date', [$currentMonthStart, $currentMonthEnd]);
        }, 'categories','savingsGoals'])->find(Auth::user()->id);

        $transactions = $user->profiles->flatMap(function ($profile) {
            return $profile->transactions;
        });

        $goals = $user->savingsGoals()->latest()->take(3)->get();
        
        $stats = [
            'income'=> $transactions->where('type', 'income')->sum('amount'),
            'expense'=> $transactions->where('type', 'expense')->sum('amount'),
    ];
        return view('dashboard.index',compact('profile','transactions','stats','goals'));
    }
}
