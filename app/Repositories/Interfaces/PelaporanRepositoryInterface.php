<?php  

namespace App\Repositories\Interfaces;

interface PelaporanRepositoryInterface {
    public function create(array $data);
    public function getById($id);
    public function update($id, array $data);
    public function delete($id);
    public function all();
    public function getAll();
    public function getAllPeninjauan();
    public function availableInLaporan($fasilitas) ;
    public function getOneByUserLaporan($idLaporan, $id_user);
    public function getLaporanByFasilitas($idLaporan);
    public function getLaporanByUser($id_user);
    public function getLaporanDidukungByUser($id);
    public function getAllLaporanByUser($id_user);
    public function updateStatus($id, $status);
    public function hasilSpk($id);
}