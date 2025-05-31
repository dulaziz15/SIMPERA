<?php  

namespace App\Services\Implementations;

use App\Repositories\Interfaces\ProfilRepositoryInterface;
use App\Services\Interfaces\ProfilServiceInterface;

class ProfilService implements ProfilServiceInterface {
    protected $profilRepository;

    public function __construct(ProfilRepositoryInterface $profilRepository){
        $this->profilRepository = $profilRepository;
    }

    public function getProfil($id) {
        return $this->profilRepository->getProfil($id);
    }

    public function updateImage($id, $request) {
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
}