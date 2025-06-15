<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\AuthRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $logService;
    
    public function __construct(LogActivityServiceInterface $logService) {
        $this->logService = $logService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
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
        $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::LOGIN, 'User Berhasil Login ke Sistem', now());
            return redirect('/dashboard');
        } else {
            return redirect('login')->withErrors([
                'surel' => 'Email atau password salah.',
            ])->withInput($request->except('hash_kata_sandi'));
        }
    }

    public function logout(Request $request)
    {
        $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::LOGOUT, 'User Berhasil Logout dari Sistem', now());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
