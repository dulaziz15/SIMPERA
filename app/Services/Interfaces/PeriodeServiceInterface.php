<?php

namespace App\Services\Interfaces;

use App\Http\Requests\PeriodeRequest;
use Illuminate\Support\Facades\Request;

interface PeriodeServiceInterface {
    public function show($id);
    public function getAll();
    public function getNow();
    public function storePeriode(PeriodeRequest $request);
    public function edit($id);
    public function update($id, PeriodeRequest $request);
    public function delete($id);
    public function getPeriodeByCreateLaporan($date);
}