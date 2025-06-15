<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LogRequest;

interface LogActivityServiceInterface {
    public function getAll();
    public function storeLog($id_pengguna, $jenis_aktivitas, $deskripsi, $waktu);
    public function show($id);
}