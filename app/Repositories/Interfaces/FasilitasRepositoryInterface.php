<?php  

namespace App\Repositories\Interfaces;

interface FasilitasRepositoryInterface {
    public function getAll();
    public function create(array $data);
    public function getById($id);
    public function update($id, array $data);
    public function delete($id);
    public function getByRuangan($ruangan);
}