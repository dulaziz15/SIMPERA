<?php  

namespace App\Repositories\Interfaces;

interface PelaporanRepositoryInterface {
    public function create(array $data);
    public function getById($id);
    public function update($id, array $data);
    public function delete($id);
    public function getAll();
    public function availableInLaporan($fasilitas) ;
    public function getOneByUserLaporan($idLaporan, $id_user);
}