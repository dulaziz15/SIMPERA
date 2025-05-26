<?php

namespace App\Repositories\Implementations;

use App\Models\PendukungLaporanModel;
use App\Repositories\Interfaces\PendukungRepositoryInterface; 

class PendukungRepository implements PendukungRepositoryInterface {
    public function createWithLaporan(array $data) {
        return PendukungLaporanModel::create($data) ? true : false;
    }
}