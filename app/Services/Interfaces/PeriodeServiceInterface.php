<?php

namespace App\Services\Interfaces;

use App\Http\Requests\PeriodeRequest;

interface PeriodeServiceInterface {
    public function create(PeriodeRequest $request);
    public function show($id);
    public function storePeriode(PeriodeRequest $request);
    public function edit($id);

    public function update($id, PeriodeRequest $request);
}