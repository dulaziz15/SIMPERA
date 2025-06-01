<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\PendukungRepositoryInterface;
use App\Services\Interfaces\PendukungServiceInterface;
use Illuminate\Support\Facades\Auth;

class PendukungService implements PendukungServiceInterface
{
    protected $pendukungRepository;

    public function __construct(PendukungRepositoryInterface $pendukungRepository)
    {
        $this->pendukungRepository = $pendukungRepository;
    }

    public function createWithLaporan(array $request)
    {
        return $this->pendukungRepository->createWithLaporan($request);
    }

    public function updateWithLaporan($data)
    {
        return $this->pendukungRepository->updateWithLaporan($data);
    }

    public function create($idLaporan, $request)
    {
        return $this->pendukungRepository->createWithLaporan([
            'id_laporan' => $idLaporan,
            'id_user' => $request->id_pengguna,
            'deskripsi' => $request->deskripsi,
            'tingkat_kerusakan' => $request->tingkat_kerusakan
        ]);
    }

    public function delete($idLaporan, $idPendukung)
    {
        return $this->pendukungRepository->delete($idLaporan, $idPendukung);
    }
}
