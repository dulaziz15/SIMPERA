<?php

namespace App\Repositories\Implementations;

use App\Models\LaporanPerbaikanModel;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;

class PelaporanRepository implements PelaporanRepositoryInterface
{
    public function getAll()
    {
        return LaporanPerbaikanModel::where('perkiraan_biaya', '!=', null)->orWhere('kerusakan','!=', null)->with(['periode', 'fasilitas', 'pengguna'])->get();
    }

    public function all() {
        return LaporanPerbaikanModel::all();
    }

    public function getAllPeninjauan() {
        return LaporanPerbaikanModel::where('perkiraan_biaya', null)->orWhere('kerusakan', null)->with(['periode', 'fasilitas', 'pengguna'])->get();
    }

    public function create(array $data)
    {
        return LaporanPerbaikanModel::create($data);
    }

    public function getById($id)
    {
        return LaporanPerbaikanModel::find($id);
    }

    public function hasilSpk($id)
    {
        $items = LaporanPerbaikanModel::find($id)->keyBy('id_laporan');

        $reordered = collect($id)->map(fn($id) => $items[$id]);

        return $reordered;
    }

    public function update($id, array $data)
    {
        return LaporanPerbaikanModel::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return LaporanPerbaikanModel::findOrFail($id)->delete() ? true : false;
    }

    public function availableInLaporan($fasilitas)
    {
        return LaporanPerbaikanModel::pluck('id_fasilitas')->toArray();
    }

    public function getOneByUserLaporan($idLaporan, $id_user)
    {
        return LaporanPerbaikanModel::find($idLaporan);
    }

    public function getLaporanByFasilitas($idFasilitas)
    {
        return LaporanPerbaikanModel::where('id_fasilitas', $idFasilitas)->first();
    }

    public function getLaporanByUser($id_user)
    {
        return LaporanPerbaikanModel::where('id_pengguna', $id_user)->where('status', '!=', 'selesai')->get();
    }

    public function getLaporanDidukungByUser($id)
    {
        return LaporanPerbaikanModel::whereHas('pendukung', function ($query) use ($id) {
            $query->where('id_user', $id)
                ->whereColumn('id_user', '!=', 'm_laporan_perbaikan.id_pengguna');
        })->where('status', '!=', 'selesai')
            ->get();
    }

    public function getAllLaporanByUser($id)
    {
        return LaporanPerbaikanModel::whereHas('pendukung', function ($query) use ($id) {
            $query->where('id_user', $id)
                ->whereColumn('id_user', '=', 'm_laporan_perbaikan.id_pengguna');
        })->where('status', '=', 'selesai')
            ->get();
    }

    public function updateStatus($id, $status)
    {
        return LaporanPerbaikanModel::find($id)->update($status) ? true : false;
    }
}
