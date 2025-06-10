<?php

namespace App\Services\Implementations;

use App\Http\Requests\PeriodeRequest;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Support\Facades\Request;

class PeriodeService implements PeriodeServiceInterface {

    protected $periodeRepository;

    public function __construct(PeriodeRepositoryInterface $periodeRepository) {
        $this->periodeRepository = $periodeRepository;
    }
    public function show($id){
        return $this->periodeRepository->show($id);
    }

    public function getAll() {
        return $this->periodeRepository->getAll();
    }

    public function storePeriode(PeriodeRequest $request){
        return $this->periodeRepository->create([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
    }
    
    public function edit($id) {
        return $this->periodeRepository->edit($id);
    }

    public function update($id, PeriodeRequest $request) {
        return $this->periodeRepository->update($id, [
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
    }

    public function delete($id){
        return $this->periodeRepository->delete($id);
    }

    public function getPeriodeByCreateLaporan($date) {
        return $this->periodeRepository->getPeriodeByCreateLaporan($date);
    }
}