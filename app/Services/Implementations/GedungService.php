<?php

namespace App\Services\Implementations;

use App\Http\Requests\GedungRequest;
use App\Http\Requests\PeriodeRequest;
use App\Repositories\Interfaces\GedungRepositoryInterface;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Support\Facades\Request;

class GedungService implements GedungServiceInterface {

    protected $gedungRepository;

    public function __construct(GedungRepositoryInterface $geddungRepository){
        $this->gedungRepository = $geddungRepository;
    }
    public function show($id) {
        return $this->gedungRepository->getById($id);
    }
    public function storeGedung(GedungRequest $request) {
        return $this->gedungRepository->create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
    }

    public function edit($id, GedungRequest $request) {
        return $this->gedungRepository->update($id, [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
    }

    public function delete($id) {
        return $this->gedungRepository->delete($id);
    }
}