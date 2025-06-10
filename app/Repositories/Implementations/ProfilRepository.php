<?php

namespace App\Repositories\Implementations;

use App\Models\ProfilModel;
use App\Repositories\Interfaces\ProfilRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProfilRepository implements ProfilRepositoryInterface
{
    public function getProfil($id)
    {
        return ProfilModel::where('id_pengguna', $id)->first();
    }

    public function updateImage($id, $data)
    {
        return ProfilModel::find($id)->update($data) ? true : false;
    }

    public function update($id, $data)
    {
        return ProfilModel::where('id_pengguna', $id)->update($data) ? true : false;
    }
}