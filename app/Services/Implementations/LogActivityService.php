<?php

namespace App\Services\Implementations;

use App\Http\Requests\LogRequest;
use App\Repositories\Interfaces\LogActivityRepositoryInterface;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Support\Facades\Auth;

class LogActivityService implements LogActivityServiceInterface {
    protected $logActivityRepository;

    public function __construct(LogActivityRepositoryInterface $logActivityRepository){
        $this->logActivityRepository = $logActivityRepository;
    }

    public function getAll()
    {
        if(Auth::user()->isUser() || Auth::user()->isTeknisi()) {
            return $this->logActivityRepository->getAll(Auth::user()->id_pengguna);
        } else {
            return $this->logActivityRepository->getAllAdmin();
        }
    }
    public function storeLog($id_pengguna, $jenis_aktivitas, $deskripsi, $waktu)
    {
        return $this->logActivityRepository->create([
            'id_pengguna' => $id_pengguna,
            'jenis_aktivitas' => $jenis_aktivitas,
            'deskripsi' => $deskripsi,
            'waktu' => $waktu
        ]);
    }

    public function show($id) {
        return $this->logActivityRepository->show($id);
    }
}