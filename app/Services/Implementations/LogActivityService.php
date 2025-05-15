<?php

namespace App\Services\Implementations;

use App\Http\Requests\LogRequest;
use App\Repositories\Interfaces\LogActivityRepositoryInterface;
use App\Services\Interfaces\LogActivityServiceInterface;

class LogActivityService implements LogActivityServiceInterface {
    protected $logActivityRepository;

    public function __construct(LogActivityRepositoryInterface $logActivityRepository){
        $this->logActivityRepository = $logActivityRepository;
    }
    public function storeLog(LogRequest $request)
    {
        return $this->logActivityRepository->create([
            'id_pengguna' => $request->id_pengguna,
            'jenis_aktivitas' => $request->jenis_aktivitas,
            'deskripsi' => $request->deskripsi,
            'waktu' => $request->waktu
        ]);
    }

    public function show($id) {
        return $this->logActivityRepository->show($id);
    }
}