<?php

namespace App\Repositories\Interfaces;

interface NotifikasiRepositoryInterface
{
    public function create($laporan, $judul, $pesan);
    public function updateRead($id);
}
