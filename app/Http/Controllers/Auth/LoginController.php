<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController 
{
   //
   public function index()
   {
      if (Auth::check()) {
         return redirect()->route('profiles.index');
     }
      return view('auth.login');
   }

   public function login(Request $request)
   {
      if (Auth::check()) {
         return redirect()->route('profiles.index');
     }
      // Validate the incoming request data
      $validated = $request->validate([
         'email' => ['required', 'email', 'exists:users,email'],
         'password' => ['required', 'string'],
      ]);

      // Attempt to log the user in
      if (Auth::attempt([
         'email' => $validated['email'],
         'password' => $validated['password']
      ], $request->remember)) {
         return redirect()->route('profiles.index')->with('success', 'login successful.');

      }

      return back()->withErrors([
         'email' => 'The provided credentials are incorrect.',
      ])->withInput(); 
   }

   public function logout(Request $request){
      // Log the user out
      Auth::logout();
      return redirect('/login')->with('success', 'logout successful.');
   }
}
