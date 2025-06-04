<?php

namespace App\Services\Implementations;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Enums\Status\StatusPenugasan;
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
                'status_progres' => StatusPenugasan::DITUGASKAN->value,
                'catatan_perubahan' => $request->catatan_perubahan
            ]);
        }
    }

    public function getPenugasanByTeknisi()
    {
        return $this->penugasanRepository->getByTeknisi(Auth::user()->id_pengguna);
    }

    public function terimaPenugasan($id)
    {
        return $this->penugasanRepository->updateStatus($id, [
            'status_progres' => StatusPenugasan::PROSES->value
        ]);
    }

    public function selesaiPenugasan($id)
    {
        $penugasan = $this->penugasanRepository->getById($id);
        $laporan = $this->laporanRepository->updateStatus($penugasan->id_laporan, [
            'status' => StatusLaporanPerbaikan::SELESAI->value
        ]);
        if ($laporan) {
            return $this->penugasanRepository->updateStatus($id, [
                'status_progres' => StatusPenugasan::SELESAI->value
            ]);
        }
    }
}
