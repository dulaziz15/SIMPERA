<?php  

namespace App\Repositories\Implementations;

use App\Models\RuanganModel;
use App\Repositories\Interfaces\RuanganRepositoryInterface;

class RuanganRepository implements RuanganRepositoryInterface {
    public function getAll() {
        return RuanganModel::with('gedung')->get();
    }

    public function getRuanganByGedung($gedung) {
        return RuanganModel::with('gedung')->where('id_gedung', $gedung)->get();
    }

    public function create($request) {
        return RuanganModel::create($request) ? true : false;
    }

    public function getById($id) {
        return RuanganModel::find($id);
    }

    public function update($id, array $data) {
        return RuanganModel::find($id)->update($data) ? true : false;
    }

    public function delete($id) {
        return RuanganModel::find($id)->delete() ? true : false;
    }
}