<?php  

namespace App\Services\Interfaces;

use App\Http\Requests\KategoriGedungRequest;

interface KategoriGedungServiceInterface {
    public function getAll();
    public function create(KategoriGedungRequest $request);
    public function getById($id);
    public function update($id, KategoriGedungRequest $request);
    public function delete($id);
}