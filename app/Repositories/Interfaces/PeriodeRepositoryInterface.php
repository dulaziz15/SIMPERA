<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\PeriodeRequest;

interface PeriodeRepositoryInterface {
    public function index();
    public function create(array $data);
    public function show($id);
    public function storePeriode(PeriodeRequest $request);
}