<?php

namespace App\Repositories\Interfaces;

interface LogActivityRepositoryInterface {
    public function create(array $data);
    public function show($id);
}