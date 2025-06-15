<?php   

namespace App\Services\Interfaces;

interface NotifikasiServiceInterface {
    public function createNotif($id, $judul, $pesan);
    public function updateRead($id);
}