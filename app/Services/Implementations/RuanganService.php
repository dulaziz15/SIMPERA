<?php  

namespace App\Services\Implementations;

use App\Repositories\Interfaces\RuanganRepositoryInterface;
use App\Services\Interfaces\RuanganServiceInterface;

class RuanganService implements RuanganServiceInterface {
    protected $ruanganRepository;

    public function __construct(RuanganRepositoryInterface $ruanganRepository){
        $this->ruanganRepository = $ruanganRepository;
    }

    public function getAll() {
        return $this->ruanganRepository->getAll();
    }

    public function getRuanganByGedung($gedung) {
        return $this->ruanganRepository->getRuanganByGedung($gedung);
    }
}