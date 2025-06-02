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
            'list' => ['Dashboard', 'Profil']
        ];

        $page = (object) [
            'title' => 'Data Profil anda'
        ];

        $activeMenu = 'profil';
        $profil = $this->userService->getUserById(Auth::user()->id_pengguna);
        // dd($profil);
        return view('profil.index', compact('profil', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function updateImage(Request $request, $id)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            $request->validate([
                'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            $profil = $this->profilService->updateImage($id, $request);
            if ($profil) {
                return response()->json([
                    'status' => true,
                    'message' => 'Foto Profil berhasil diubah.',
                    'redirect' => url('/profil')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Foto Profil Gagal diubah.',
                    'redirect' => url('/profil')
                ]);
            }
        }

        return redirect('/profil');
    }
}
