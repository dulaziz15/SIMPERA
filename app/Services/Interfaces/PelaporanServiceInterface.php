<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\PelaporanRequest;

interface PelaporanServiceInterface {
    public function getAll();
    public function storePelaporan(PelaporanRequest $request);
    public function show($id);
    public function update($id, PelaporanRequest $request);
    public function delete($id);
}