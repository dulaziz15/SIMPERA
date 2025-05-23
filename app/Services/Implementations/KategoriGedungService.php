<?php  

namespace App\Services\Implementations;

use App\Http\Requests\KategoriGedungRequest;
use App\Repositories\Interfaces\KategoriGedungRepositoryInterface;
use App\Services\Interfaces\KategoriGedungServiceInterface;

class KategoriGedungService implements KategoriGedungServiceInterface {
    protected $kategoriGedungRepository;

    public function __construct(KategoriGedungRepositoryInterface $kategoriGedungRepository){
        $this->kategoriGedungRepository = $kategoriGedungRepository;
    }

    public function getAll() {
        return $this->kategoriGedungRepository->getAll();
    }

    public function create(KategoriGedungRequest $request) {
        return $this->kategoriGedungRepository->create([
            'kategori_gedung' => $request->kategori_gedung
        ]);
    }

    public function getById($id) {
        return $this->kategoriGedungRepository->getById($id);
    }

    public function update($id, KategoriGedungRequest $request) {
        return $this->kategoriGedungRepository->update($id, [
            'kategori_gedung' => $request->kategori_gedung,
        ]);
    }

    public function delete($id) {
        return $this->kategoriGedungRepository->delete($id);
    }
}