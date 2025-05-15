<?php

namespace App\Services\Implementations;

use App\Http\Requests\PeranRequest;
use App\Repositories\Interfaces\PeranRepositoryInterface;
use App\Services\Interfaces\PeranServiceInterface;
use Illuminate\Support\Facades\Request;

class PeranService implements PeranServiceInterface {
    protected $peranRepository;

    public function __construct(PeranRepositoryInterface $peranRepository){
        $this->peranRepository = $peranRepository;
    }
    
    public function show($id) {
        return $this->peranRepository->getById($id);
    }

    public function storePeran(PeranRequest $request) {
        return $this->peranRepository->create([
            'kode_peran' => $request->kode_peran,
            'nama' => $request->nama
        ]);
    }

    public function edit($id, PeranRequest $request) {
        return $this->peranRepository->update($id, [
            'kode_peran' => $request->kode_peran,
            'nama' => $request->nama
        ]);
    }

    public function delete($id) {
        return $this->peranRepository->delete($id);
    }
}