<?php  

namespace App\Repositories\Interfaces;

interface RuanganRepositoryInterface {
    public function getAll();
    public function getRuanganByGedung($gedung);
}