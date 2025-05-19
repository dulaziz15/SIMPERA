<?php

namespace App\Repositories\Implementations;

use App\Models\GedungModel;
use App\Repositories\Interfaces\GedungRepositoryInterface;

class GedungRepository implements GedungRepositoryInterface {
    public function getAll() {
        return GedungModel::all();
    }
    public function create(array $data) {
        return GedungModel::create($data) ? true : false;
    }

    public function getById($id) {
        return GedungModel::find($id);
    }

    public function update($id, array $data) {
        $gedung = GedungModel::findOrFail($id);
        return $gedung->update($data) ? true : false;
    }

    public function delete($id) {
        $gedung = GedungModel::findOrFail($id);
        return $gedung->delete() ? true : false;
    }
}