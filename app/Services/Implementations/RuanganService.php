<?php  

namespace App\Services\Implementations;

use App\Http\Requests\RuanganRequest;
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

    public function create(RuanganRequest $request) {
        return $this->ruanganRepository->create([
            'id_gedung' => $request->id_gedung,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'lantai' => $request->lantai,
            'deskripsi' => $request->deskripsi
        ]);
    }

    public function show($id) {
        return $this->ruanganRepository->getById($id);
    }

    public function update($id, RuanganRequest $request) {
        return $this->ruanganRepository->update($id, [
            'id_gedung' => $request->id_gedung,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'lantai' => $request->lantai,
            'deskripsi' => $request->deskripsi
        ]);
    }

    public function delete($id) {
        return $this->ruanganRepository->delete($id);
    }

    public function getByGedung($gedung) {
        return $this->ruanganRepository->getByGedung($gedung);
    }
}