<?php

namespace App\Services\Implementations;

use App\Http\Requests\ProfilRequest;
use App\Repositories\Interfaces\ProfilRepositoryInterface;
use App\Services\Interfaces\ProfilServiceInterface;

class ProfilService implements ProfilServiceInterface
{
    protected $profilRepository;

    public function __construct(ProfilRepositoryInterface $profilRepository)
    {
        $this->profilRepository = $profilRepository;
    }

    public function getProfil($id)
    {
        return $this->profilRepository->getProfil($id);
    }

    public function updateImage($id, $request)
    {
        $imageName = null;
        // dd($imageName);
        if ($request->hasFile('gambar')) {
            $url_foto = $request->file('gambar');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('foto_profil', $imageName, 'public');
        }
        return $this->profilRepository->updateImage($id, [
            'foto_profil' => $imageName
        ]);
    }

    public function update(ProfilRequest $request, $id)
    {
        $profil = $this->profilRepository->getProfil($id);
        $isChanged = false;
        $imageUpdated = false;
        $imageName = null;
        if ($request->hasFile('gambar')) {
            $url_foto = $request->file('gambar');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('foto_profil', $imageName, 'public');
            $imageUpdated = true;
        }
        if ($profil && $profil->nama_lengkap !== $request->nama_lengkap) {
            $isChanged = true;
        }
        if ($imageUpdated) {
            $this->profilRepository->updateImage($id, [
                'foto_profil' => $imageName
            ]);
        }
        if ($isChanged) {
            $updated = $this->profilRepository->update($id, [
                'nama_lengkap' => $request->nama_lengkap,
            ]);
            return [
                'status' => $updated || $imageUpdated,
                'message' => ($updated || $imageUpdated) ? 'Data berhasil diupdate.' : 'Data gagal diupdate.'
            ];
        } elseif ($imageUpdated) {
            return [
                'status' => true,
                'message' => 'Foto profil berhasil diupdate.'
            ];
        } else {
            return [
                'status' => true,
                'message' => 'Tidak ada perubahan data.'
            ];
        }
    }
}