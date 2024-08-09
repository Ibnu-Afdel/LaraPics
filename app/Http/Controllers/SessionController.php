<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if (! Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials.'
            ]);
        }
        $request->session()->regenerate();
        return redirect()->route('posts.index');
    }

    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('posts.index');
    }
}
