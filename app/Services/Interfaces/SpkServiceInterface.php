<?php  

namespace App\Services\Interfaces;

interface SpkServiceInterface {
    public function alternatif();
    public function kriteria();
    public function normalisasi();
    public function preferensi();
    public function persimpanganPreferensi();
    public function bobot();
    public function ranking();
    public function hasilSpk();
    public function hasil();
}