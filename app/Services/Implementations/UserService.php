<?php

namespace App\Services\Implementations;

use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAll() {
        return $this->userRepository->getAll();
    }

    public function createUser(UserRequest $request) {
        return $this->userRepository->storeUser([
            'nama_pengguna' => $request->nama_pengguna,
            'hash_kata_sandi' => $request->hash_kata_sandi,
            'id_peran' => $request->id_peran,
            'surel' => $request->surel
        ]);
    }

    public function updateProfile($id, UserRequest $request) {
        return $this->userRepository->update($id, [
            'nama_pengguna' => $request->nama_pengguna,
            'hash_kata_sandi' => $request->hash_kata_sandi,
            'id_peran' => $request->id_peran,
            'surel' => $request->surel
        ]);
    }

    public function getAllUsers() {
        return $this->userRepository->getAll();
    }

    public function getUserById($id) {
        return $this->userRepository->getUserById($id);
    }

    public function getUserByPeran($peran) {
        return $this->userRepository->getUserByPeran($peran);
    }

    // public function getUserByNama($nama) {

    // }

    public function deleteUser($id) {
        return $this->userRepository->delete($id);
    }
}