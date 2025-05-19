<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\GedungRequest;
use App\Http\Requests\PeriodeRequest;

interface GedungRepositoryInterface {
    public function getAll();
    public function create(array $data);

    public function getById($id);

    public function update($id, array $data);
    public function delete($id);
}