<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ProfilServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    protected $profilService;
    protected $userService;

    public function __construct(ProfilServiceInterface $profilService, UserServiceInterface $userService)
    {
        $this->profilService = $profilService;
        $this->userService = $userService;
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Profil',
            'list' => ['Home', 'Profil']
        ];

        $page = (object) [
            'title' => 'Data Profil anda'
        ];

        $activeMenu = 'profil';
        $profil = $this->userService->getUserById(Auth::user()->id_pengguna);
        // dd($profil);
        return view('profil.index', compact('profil', 'breadcrumb', 'page', 'activeMenu'));
    }
}
