<?php

namespace App\Repositories\Interfaces;

interface LogActivityRepositoryInterface {
    public function getAll($id_pengguna);
    public function getAllAdmin();
    public function create(array $data);
    public function show($id);
}