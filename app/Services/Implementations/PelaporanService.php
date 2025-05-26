<?php

namespace App\Services\Implementations;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Http\Requests\PelaporanRequest;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PendukungServiceInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Support\Facades\Auth;

class PelaporanService implements PelaporanServiceInterface
{
    protected $pelaporanRepository;
    protected $periodeService;
    protected $pendukungService;

    public function __construct(
        PelaporanRepositoryInterface $pelaporanRepository,
        PeriodeServiceInterface $periodeService,
        PendukungServiceInterface $pendukungService
    ) {
        $this->pelaporanRepository = $pelaporanRepository;
        $this->periodeService = $periodeService;
        $this->pendukungService = $pendukungService;
    }

    public function getAll()
    {
        return $this->pelaporanRepository->getAll();
    }

    public function storePelaporan(PelaporanRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('url_foto')) {
            $url_foto = $request->file('url_foto');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('uploads/fasilitas', $imageName, 'public');
        }

        $periode = $this->periodeService->getPeriodeByCreateLaporan(now());

        if (empty($periode)) {
            return false;
        }

        $laporan =  $this->pelaporanRepository->create([
            'id_pengguna' => Auth::user()->id_pengguna,
            'id_fasilitas' => $request->id_fasilitas,
            'id_periode' => $periode->id_periode,
            'deskripsi' => $request->deskripsi,
            'url_foto' => $imageName,
            'status' => StatusLaporanPerbaikan::BARU->value,
            'waktu_pelaporan' => now(),
            'waktu_perubahan' => now()
        ]);

        if ($laporan) {
            return $this->pendukungService->createWithLaporan([
                'id_laporan' => $laporan->id_laporan,
                'id_user' => $request->id_pengguna ?? Auth::user()->id_pengguna,
                'deskripsi' => $request->deskripsi,
                'tingkat_kerusakan' => $request->tingkat_kerusakan
            ]);
        }

        return false;
    }

    public function show($id)
    {
        return $this->pelaporanRepository->getById($id);
    }

    public function update($id, PelaporanRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('url_foto')) {
            $url_foto = $request->file('url_foto');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('uploads/fasilitas', $imageName, 'public');
        }

        // Ambil data lama (optional jika ingin cek/fallback)
        $oldData = $this->pelaporanRepository->getById($id);

        return $this->pelaporanRepository->update($id, [
            'id_pengguna' => $request->id_pengguna,
            'id_fasilitas' => $request->id_fasilitas,
            'deskripsi' => $request->deskripsi,
            'url_foto' => $imageName ?? $oldData->url_foto,
            'status' => $request->status ?? $oldData->status,
            'waktu_pelaporan' => now(),
            'waktu_perubahan' => now()
        ]);
    }

    public function delete($id)
    {
        return $this->pelaporanRepository->delete($id);
    }
}
