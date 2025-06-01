<?php  

namespace App\Services\Interfaces;

interface ProfilServiceInterface {
    public function getProfil($id);
    public function updateImage($id, $request);
}