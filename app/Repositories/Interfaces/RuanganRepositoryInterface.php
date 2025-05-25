<?php  

namespace App\Repositories\Interfaces;

interface RuanganRepositoryInterface {
    public function getAll();
    public function getRuanganByGedung($gedung);
    public function create(array $request);
    public function getById($id);
    public function update($id, array $data);
    public function delete($id);
}