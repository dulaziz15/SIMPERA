<?php  

namespace App\Repositories\Implementations;

use App\Models\FasilitasModel;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;

class FasilitasRepository implements FasilitasRepositoryInterface {
    public function getAll(){
        return FasilitasModel::with('ruangan', 'kategori', 'ruangan.gedung')->get();
    }

    public function create(array $data) {
        return FasilitasModel::create($data) ? true : false;
    }

    public function getById($id) {
        return FasilitasModel::find($id);
    }

    public function update($id, array $data) {
        $fasilitas = FasilitasModel::findOrFail($id);
        return $fasilitas->update($data) ? true : false;
    }

    public function delete($id) {
        $fasilitas =  FasilitasModel::findOrFail($id);
        return $fasilitas->delete() ? true : false;
    }
}