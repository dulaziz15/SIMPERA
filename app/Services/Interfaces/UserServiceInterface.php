<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProfilRequest;
use App\Http\Requests\UserRequest;

interface UserServiceInterface
{
    public function countUserByPeran();
    public function getAll();
    public function createUser(UserRequest $request);
    public function createProfil(ProfilRequest $request, $id);
    public function updateProfile($id, UserRequest $request);
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByPeran($peran);
    // public function getUserByNama($nama);
    public function deleteUser($id);
    public function fotoHandler($foto);
}