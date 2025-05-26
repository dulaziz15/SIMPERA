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
}