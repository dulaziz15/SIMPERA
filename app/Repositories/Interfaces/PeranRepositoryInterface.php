<?php

namespace App\Repositories\Interfaces;

interface PeranRepositoryInterface {
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}