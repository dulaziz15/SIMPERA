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
}