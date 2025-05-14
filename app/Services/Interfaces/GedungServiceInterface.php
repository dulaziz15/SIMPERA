<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GedungRequest;
use App\Http\Requests\PeriodeRequest;
use Illuminate\Support\Facades\Request;

interface GedungServiceInterface {
    public function show($id);
    public function storeGedung(GedungRequest $requeat);
    public function edit($id, GedungRequest $request);
    public function delete($id);
}