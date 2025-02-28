<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController 
{
   //

   public function index()
   {
      if (Auth::check()) {
         return redirect()->route('profiles.index');
     }
      return view('auth.register');
   }


   public function register(Request $request)
   {
      if (Auth::check()) {
         return redirect()->route('profiles.index');
     }
      // Validate the incoming request data
      $validated = $request->validate([
         'family_account' => ['required', 'string', 'max:255'],
         'user_name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'pin'=> ['required', 'string', 'max:4','min:4'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      $user = User::create([
         'name' => $validated['family_account'],
         'email' => $validated['email'],
         'password' => Hash::make($validated['password']),
      ]);
      if($user->id){
         Profile::create([
            'user_id'=>$user->id,
            'name'=>ucfirst( $validated['user_name']),
            'pin'=> $validated['pin'],
            'description'=>"The Father of family ",
         ]);
      }
      Auth::login($user);
      return redirect('/login')->with('success', 'register successful.');
   }

}
