<?php

namespace App\Services\Interfaces;

use App\Http\Requests\UserRequest;

interface UserServiceInterface {
    public function createUser(UserRequest $request);
    public function updateProfile($id, UserRequest $request);
    public function getAllUsers();
    public function getUserById($id);
    // public function getUserByPeran($peran);
    // public function getUserByNama($nama);
    public function deleteUser($id);
}