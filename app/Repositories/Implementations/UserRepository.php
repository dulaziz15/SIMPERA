<?php

namespace App\Repositories\Implementations;

use App\Models\ProfilModel;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function storeUser($data)
    {
        return User::create($data) ? true : false;
    }

    public function getAll()
    {
        return User::with('peran')->with('profil')->get();
    }

    public function search($request)
    {
        $query = User::query()->with('peran');

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pengguna', 'like', '%' . $request->keyword . '%')
                    ->orWhere('surel', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->role) {
            $query->whereHas('peran', function ($q) use ($request) {
                $q->where('nama', $request->role);
            });
        }

        return $query->limit(10)->get();
    }

    public function countUserByPeran($id)
    {
        return User::select('id_peran', DB::raw('count(*) as total'))
            ->groupBy('id_peran')
            ->pluck('total', 'id_peran')
            ->toArray();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserByPeran($peran)
    {
        return User::where('id_peran', $peran)->with('peran')->get();
    }

    public function update($id, $data)
    {
        return User::where('id_pengguna', $id)->update($data) ? true : false;
    }

    public function delete($id)
    {
        return User::where('id_pengguna', $id)->delete();
    }

    public function storeProfil($data)
    {
        return ProfilModel::create($data) ? true : false;
    }
}
