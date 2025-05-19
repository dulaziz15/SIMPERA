<?php

namespace App\Services\Interfaces;

use App\Http\Requests\GedungRequest;

interface GedungServiceInterface {
    public function getAll();
    public function show($id);
    public function storeGedung(GedungRequest $requeat);
    public function edit($id, GedungRequest $request);
    public function delete($id);
}