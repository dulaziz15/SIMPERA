<?php

namespace App\Repositories\Implementations;

use App\Models\KategoriFasilitasModel;
use App\Repositories\Interfaces\KategoriFasilitasRepositoryInterface;

class KategoriFasilitasRepository implements KategoriFasilitasRepositoryInterface {
    public function create(array $data) {
        return KategoriFasilitasModel::create($data) ? true : false;
    }

    public function getById($id) {
        return KategoriFasilitasModel::find($id) ? true : false;
    }

    public function update($id, array $data) {
        $kategori = KategoriFasilitasModel::findOrFail($id);
        return $kategori->update($data);
    }

    public function delete($id) {
        $kategori = KategoriFasilitasModel::findOrFail($id);
        return $kategori->delete() ? true : false;
    }
}