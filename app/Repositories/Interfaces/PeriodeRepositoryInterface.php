<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\PeriodeRequest;

interface PeriodeRepositoryInterface {
    public function create(array $data);
    public function show($id);
    public function edit($id);
    public function update($id, array $data);
    public function delete($id);
    public function getPeriodeByCreateLaporan($date);
}