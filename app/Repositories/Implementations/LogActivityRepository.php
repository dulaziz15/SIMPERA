<?php

namespace App\Repositories\Implementations;

use App\Models\LogActivityModel;
use App\Repositories\Interfaces\LogActivityRepositoryInterface;

class LogActivityRepository implements LogActivityRepositoryInterface {
    public function create(array $data) {
        return LogActivityModel::create($data) ? true : false;
    }

    public function show($id) {
        return LogActivityModel::find($id);
    }
}