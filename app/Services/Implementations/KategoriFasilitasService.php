<?php 

namespace App\Services\Implementations;

use App\Http\Requests\KategoriRequest;
use App\Repositories\Interfaces\KategoriFasilitasRepositoryInterface;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;

class KategoriFasilitasService implements KategoriFasilitasServiceInterface {
    protected $kategoriFasilitasRepository;
    
    public function __construct(KategoriFasilitasRepositoryInterface $kategoriFasilitasRepository) {
        $this->kategoriFasilitasRepository = $kategoriFasilitasRepository;
    }

    public function getAll() {
        return $this->kategoriFasilitasRepository->getAll();
    }

    public function storeKategori(KategoriRequest $request) {
        return $this->kategoriFasilitasRepository->create([
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
    }
    public function show($id) {
        return $this->kategoriFasilitasRepository->getById($id);
    }

    public function edit($id, KategoriRequest $request) {
        return $this->kategoriFasilitasRepository->update($id, [
            'kode' => $request->kode,
            'nama' => $request->nama
        ]);
    }

    public function delete($id){
        return $this->kategoriFasilitasRepository->delete($id);
    }
}