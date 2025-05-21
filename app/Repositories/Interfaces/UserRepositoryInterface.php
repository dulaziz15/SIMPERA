<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function storeUser(array $data);
    public function getAll();
    public function countUserByPeran($id);
    public function getUserById($id);
    public function getUserByPeran($peran);
    public function update($id, array $data);
    public function delete($id);

}