<?php  

namespace App\Repositories\Interfaces;

interface PendukungRepositoryInterface {
    public function createWithLaporan(array $data);
    public function updateWithLaporan($data);
    public function delete($idLaporan, $idPendukung);
}