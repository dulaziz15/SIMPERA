<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\RuanganRequest;

interface RuanganServiceInterface {
    public function getAll();
    public function getRuanganByGedung($gedung);
    public function create(RuanganRequest $request);
    public function show($id);
    public function update($id, RuanganRequest $request);
    public function delete($id);
    public function getByGedung($gedung);
}