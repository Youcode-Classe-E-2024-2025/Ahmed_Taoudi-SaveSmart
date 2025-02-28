<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
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
        // dd($profile->transactions);
        return view('dashboard.index',compact('profile'));
    }
}
