<?php

namespace App\Services\Implementations;

use App\Http\Requests\PeriodeRequest;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Services\Interfaces\PeriodeServiceInterface;

class PeriodeService implements PeriodeServiceInterface {

    protected $periodeRepository;

    public function __construct(PeriodeRepositoryInterface $periodeRepository) {
        $this->periodeRepository = $periodeRepository;
    }

    public function create(PeriodeRequest $request){

    }
    public function show($id){

    }
    public function storePeriode(PeriodeRequest $request){
        return $this->periodeRepository->create([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
    }
    
}