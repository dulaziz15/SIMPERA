<?php

namespace App\Repositories\Implementations;

use App\Models\PendukungLaporanModel;
use App\Repositories\Interfaces\PendukungRepositoryInterface; 

class PendukungRepository implements PendukungRepositoryInterface {
    public function createWithLaporan(array $data) {
        return PendukungLaporanModel::create($data) ? true : false;
    }

    public function updateWithLaporan($data) {
        // dd($data['id_user']);
        return PendukungLaporanModel::where('id_laporan', $data['id_laporan'])->where('id_user', $data['id_user'])->update($data);
    }

    public function delete($idLaporan, $idPendukung) {
        return PendukungLaporanModel::where('id_laporan', $idLaporan)->where('id_user', $idPendukung)->delete() ? true : false;
    }
}