<?php

namespace App\Services\Implementations;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Enums\Status\statusPenugasan;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Repositories\Interfaces\PenugasanRepositoryInterface;
use App\Services\Interfaces\PenugasanServiceInterface;
use Illuminate\Support\Facades\Auth;

class PenugasanService implements PenugasanServiceInterface
{
    protected $penugasanRepository;
    protected $laporanRepository;

    public function __construct(
        PenugasanRepositoryInterface $penugasanRepository,
        PelaporanRepositoryInterface $pelaporanRepository
    ) {
        $this->penugasanRepository = $penugasanRepository;
        $this->laporanRepository = $pelaporanRepository;
    }

    public function storePenugasan($idLaporan, $request)
    {
        $laporan = $this->laporanRepository->updateStatus($idLaporan, [
            'status' => StatusLaporanPerbaikan::PERBAIKAN->value,
            'waktu_perubahan' => now()
        ]);
        if ($laporan) {
            return $this->penugasanRepository->create([
                'id_laporan' => $idLaporan,
                'id_teknisi' => $request->id_teknisi,
                'ditugaskan_oleh' => Auth::user()->id_pengguna,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status_progres' => statusPenugasan::DITUGASKAN->value,
                'catatan_perubahan' => $request->catatan_perubahan
            ]);
        }
    }
}
