<?php

namespace App\Repositories\Implementations;

use App\Models\PeranModel;
use App\Repositories\Interfaces\PeranRepositoryInterface;

class PeranRepository implements PeranRepositoryInterface {
    public function getAll() {
        return PeranModel::all();
    }
    public function getById($id) {
        return PeranModel::find($id);
    }

    public function create(array $data) {
        return PeranModel::create($data) ? true : false;
    }

    public function update($id, array $data) {
        $peran = PeranModel::findOrFail($id);
        return $peran->update($data) ? true : false;
    }

    public function delete($id) {
        $peran = PeranModel::findOrFail($id);
        return $peran->delete() ? true : false;
    }
}