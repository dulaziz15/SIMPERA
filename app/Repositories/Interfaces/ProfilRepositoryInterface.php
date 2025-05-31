<?php  

namespace App\Repositories\Interfaces;

interface ProfilRepositoryInterface {
    public function getProfil($id);
    public function updateImage($id, $data);
}