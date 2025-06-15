<?php   

namespace App\Services\Implementations;

use App\Repositories\Interfaces\NotifikasiRepositoryInterface;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Services\Interfaces\NotifikasiServiceInterface;

class NotifikasiService implements NotifikasiServiceInterface
{
    protected $notifikasiRepository;
    protected $laporanRepository;
    public function __construct(NotifikasiRepositoryInterface $notifikasiRepository, 
        PelaporanRepositoryInterface $laporanRepository)
    {
        $this->notifikasiRepository = $notifikasiRepository;
        $this->laporanRepository = $laporanRepository;
    }
    public function createNotif($id, $judul, $pesan)
    {
        $laporan = $this->laporanRepository->getById($id);
        return $this->notifikasiRepository->create($laporan, $judul, $pesan);
    }
    public function updateRead($id)
    {
        return $this->notifikasiRepository->updateRead($id);
    }
}