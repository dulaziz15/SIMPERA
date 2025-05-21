<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'surel' => $request->surel,
            'password' => $request->hash_kata_sandi
        ];
        if (Auth::attempt($credentials)) {
            return redirect('');
        } else {
            return redirect('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
