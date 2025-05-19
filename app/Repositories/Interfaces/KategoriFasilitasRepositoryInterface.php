<?php

namespace App\Repositories\Interfaces;


interface KategoriFasilitasRepositoryInterface {
    public function getAll();
    public function create(array $data);

    public function getById($id);

    public function update($id, array $data);
    public function delete($id);
}