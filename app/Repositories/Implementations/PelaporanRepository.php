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
        return LaporanPerbaikanModel::findOrFail($id)->update($data);
    }

    public function delete($id) {
        return LaporanPerbaikanModel::findOrFail($id)->delete() ? true : false;
    }

    public function availableInLaporan($fasilitas) {
        return LaporanPerbaikanModel::pluck('id_fasilitas')->toArray();
    }

    public function getOneByUserLaporan($idLaporan, $id_user) {
        return LaporanPerbaikanModel::find($idLaporan);
    }

    public function getLaporanByFasilitas($idFasilitas) {
        return LaporanPerbaikanModel::where('id_fasilitas', $idFasilitas)->first();
    }
}