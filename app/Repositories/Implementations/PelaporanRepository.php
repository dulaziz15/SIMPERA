<?php  

namespace App\Repositories\Implementations;

use App\Models\LaporanPerbaikanModel;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;

class PelaporanRepository implements PelaporanRepositoryInterface {
    public function getAll() {
        return LaporanPerbaikanModel::with(['periode', 'fasilitas', 'pengguna'])->get();
    }

    public function create(array $data) {
        return LaporanPerbaikanModel::create($data);
    }

    public function getById($id) {
        return LaporanPerbaikanModel::find($id);
    }

    public function update($id, array $data) {
        $pelaporan = LaporanPerbaikanModel::findOrFail($id);
        return $pelaporan->update($data) ? true : false;
    }

    public function delete($id) {
        $pelaporan = LaporanPerbaikanModel::findOrFail($id);
        return $pelaporan->delete()? true : false;
    }

    public function availableInLaporan($fasilitas) {
        return LaporanPerbaikanModel::pluck('id_fasilitas')->toArray();
    }
}