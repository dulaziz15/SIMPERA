<?php  

namespace App\Services\Interfaces;

interface PendukungServiceInterface {
    public function createWithLaporan(array $data);
    public function updateWithLaporan(array $data);
    public function create($idLaporan, $data);
}