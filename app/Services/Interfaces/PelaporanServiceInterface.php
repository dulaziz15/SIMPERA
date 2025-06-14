<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\PelaporanRequest;

interface PelaporanServiceInterface {
    public function all();
    public function getAll();
    public function getByPeriode();
    public function getLaporanSering(string $startDate, string $endDate);
    public function filterByDate(string $startDate, string $endDate);
    public function getLaporanSeringThisPeriode();
    public function getBiayaPerbaikan();
    public function getLaporanPerPeriode();
    public function getAllPeninjauan();
    public function storePelaporan(PelaporanRequest $request);
    public function show($id);
    public function storePeninjauan($request, $id);
    public function getLaporanById($id);
    public function update($id, PelaporanRequest $request);
    public function delete($id);
    public function getLaporanByFasilitas($idFasilitas);
    public function getLaporanByUser($id_user);
    public function getLaporanDidukungByUser($id);
    public function getAllLaporanByUser($id_user);
    public function pengajuan($id);
    public function verifikasi($id);
    public function hasilSpk($id);
}