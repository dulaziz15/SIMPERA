<?php 

namespace App\Repositories\Implementations;

use App\Models\ProfilModel;
use App\Repositories\Interfaces\ProfilRepositoryInterface;

class ProfilRepository implements ProfilRepositoryInterface {
    public function getProfil($id) {
        return ProfilModel::where('id_pengguna', $id)->first();
    }
}