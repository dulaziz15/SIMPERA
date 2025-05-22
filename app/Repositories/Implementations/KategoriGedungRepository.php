<?php  

namespace App\Repositories\Implementations;

use App\Models\KategoriGedungModel;
use App\Repositories\Interfaces\KategoriGedungRepositoryInterface;

class KategoriGedungRepository implements KategoriGedungRepositoryInterface {
    public function getAll() {
        return KategoriGedungModel::all();
    }

    public function create(array $data) {
        return KategoriGedungModel::create($data) ? true : false;
    }

    public function getById($id) {
        return KategoriGedungModel::find($id);
    }

    public function update($id, array $data) {
        return KategoriGedungModel::find($id)->update($data) ? true : false;
    }

    public function delete($id) {
        return KategoriGedungModel::find($id)->delete() ? true : false;
    }
}