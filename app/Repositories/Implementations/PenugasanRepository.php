<?php  

namespace App\Repositories\Implementations;

use App\Models\LaporanPerbaikanModel;
use App\Models\PenugasanModel;
use App\Repositories\Interfaces\PenugasanRepositoryInterface;

class PenugasanRepository implements PenugasanRepositoryInterface {
    public function create($data){
        return PenugasanModel::create($data) ? true : false;
    }

    public function getByTeknisi($id) {
        return PenugasanModel::where('id_teknisi', $id)->get();
    }

    public function updateStatus($id, $data) {
        return PenugasanModel::find($id)->update($data) ? true : false;
    }
}