<?php

namespace App\Services\Implementations;

use App\Http\Requests\FasilitasRequest;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Services\Interfaces\FasilitasServiceInterface;

class FasilitasService implements FasilitasServiceInterface
{
    protected $fasilitasRepository;
    protected $pelaporanRespository;

    public function __construct(FasilitasRepositoryInterface $fasilitasRepository, PelaporanRepositoryInterface $pelaporanRepository)
    {
        $this->fasilitasRepository = $fasilitasRepository;
        $this->pelaporanRespository = $pelaporanRepository;
    }

    public function storeFasilitas(FasilitasRequest $request)
    {
        $imageName = null;
        if ($request->hasFile('gambar')) {
            $url_foto = $request->file('gambar');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('uploads/fasilitas', $imageName, 'public');
        }

        return $this->fasilitasRepository->create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_ruangan' => $request->id_ruangan,
            'status' => $request->status,
            'gambar' => $imageName
        ]);
    }

    public function show($id)
    {
        return $this->fasilitasRepository->getById($id);
    }

    public function update($id, FasilitasRequest $request)
    {
        return $this->fasilitasRepository->update($id, [
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_ruangan' => $request->id_ruangan,
            'status' => $request->status
        ]);
    }

    public function delete($id)
    {
        return $this->fasilitasRepository->delete($id);
    }

    public function getAll()
    {
        return $this->fasilitasRepository->getAll();
    }

    public function search($request)
    {
        return $this->fasilitasRepository->search($request);
    }

    public function getByRuangan($ruangan)
    {
        
        $allFasilitas =  $this->fasilitasRepository->getByRuangan($ruangan);
        // Ambil fasilitas yang sudah ada di laporan
        $reportedFasilitas = $this->pelaporanRespository->availableInLaporan($allFasilitas);

        // Filter hanya yang belum dilaporkan
        return $allFasilitas->reject(function ($fasilitas) use ($reportedFasilitas) {
            return in_array($fasilitas->id_fasilitas, $reportedFasilitas);
        });
    }

    public function getAllFasilitasByRuangan($id) {
        return $this->fasilitasRepository->getAllFasilitasByRuangan($id);
    }
}
