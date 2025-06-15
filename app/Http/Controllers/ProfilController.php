<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\ProfilRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\ProfilServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    protected $profilService;
    protected $userService;
    protected $logService;

    public function __construct(ProfilServiceInterface $profilService, UserServiceInterface $userService, LogActivityServiceInterface $logService)
    {
        $this->profilService = $profilService;
        $this->userService = $userService;
        $this->logService = $logService;
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
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah foto profil', now());
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

    public function edit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('profil.edit', compact('data'));
    }

    public function update(ProfilRequest $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $result = $this->profilService->update($request, $id);
            $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah data profil dalam sistem', now());
            return response()->json([
                'status' => (bool) $result['status'],
                'message' => $result['message']
            ]);
        }
        return redirect('/profil');
    }
}
