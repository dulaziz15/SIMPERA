<?php  

namespace App\Repositories\Implementations;

use App\Models\LaporanPerbaikanModel;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;

class PelaporanRepository implements PelaporanRepositoryInterface {
    public function getAll() {
        return LaporanPerbaikanModel::all();
    }
    public function create(array $data) {
        return LaporanPerbaikanModel::create($data) ? true : false;
    }

    public function getById($id) {
        return LaporanPerbaikanModel::find($id) ? true : false;
    }

    public function update($id, array $data) {
        $pelaporan = LaporanPerbaikanModel::findOrFail($id);
        return $pelaporan->update($data) ? true : false;
    }

    public function delete($id) {
        $pelaporan = LaporanPerbaikanModel::findOrFail($id);
        return $pelaporan->delete()? true : false;
    }
}