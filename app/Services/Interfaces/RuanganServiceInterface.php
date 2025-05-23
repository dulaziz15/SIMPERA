<?php 

namespace App\Services\Interfaces;

interface RuanganServiceInterface {
    public function getAll();
    public function getRuanganByGedung($gedung);
}