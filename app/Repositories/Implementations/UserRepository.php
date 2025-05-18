<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    public function storeUser($data) {
        // $data['hash_kata_sandi'] = bcrypt($data['hash_kata_sandi']);
        return User::create($data)? true : false;
    }

    public function getAll() {
        return User::all();
    }

    public function getUserById($id) {
        return User::findOrFail($id);
    }

    public function update($id, $data) {
        // $data['hash_kata_sandi'] = bcrypt($data['hash_kata_sandi']);

        return User::where('id_pengguna', $id)->update($data)? true : false;
    }

    public function delete($id) {
        return User::where('id_pengguna', $id)->delete();
    }
}