<?php
namespace App\Services\Implementations;

use App\Http\Requests\PelaporanRequest;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Services\Interfaces\PelaporanServiceInterface;

class PelaporanService implements PelaporanServiceInterface
{
    protected $pelaporanRepository;

    public function __construct(PelaporanRepositoryInterface $pelaporanRepository)
    {
        $this->pelaporanRepository = $pelaporanRepository;
    }

    public function getAll() {
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

        return $this->pelaporanRepository->create([
            'id_pengguna' => $request->id_pengguna,
            'id_fasilitas' => $request->id_fasilitas,
            'deskripsi' => $request->deskripsi,
            'url_foto' => $imageName,
            'status' => $request->status,
            'waktu_pelaporan' => now(),
            'waktu_perubahan' => now()
        ]);
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

    public function delete($id) {
        return $this->pelaporanRepository->delete($id);
    }
}
