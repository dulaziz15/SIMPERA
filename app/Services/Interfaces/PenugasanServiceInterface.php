<?php  

namespace App\Services\Interfaces;

interface PenugasanServiceInterface {
    public function storePenugasan($idLaporan, $request);
    public function getPenugasanByTeknisi();
    public function getById($id);
    public function terimaPenugasan($id);
    public function selesaiPenugasan($id);
}