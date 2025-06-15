<?php

namespace App\Repositories\Implementations;

use App\Models\LogActivityModel;
use App\Repositories\Interfaces\LogActivityRepositoryInterface;

class LogActivityRepository implements LogActivityRepositoryInterface {
    public function getAll($id_pengguna) {
        return LogActivityModel::with(['pengguna'])->where('id_pengguna', $id_pengguna)->orderBy('waktu', 'desc')->get();
    }

    public function getAllAdmin() {
        return LogActivityModel::with(['pengguna'])->orderBy('waktu', 'desc')->get();
    }
    
    public function create(array $data) {
        return LogActivityModel::create($data) ? true : false;
    }

    public function show($id) {
        return LogActivityModel::find($id);
    }
}