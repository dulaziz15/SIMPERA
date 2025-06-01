<?php

namespace App\Repositories\Implementations;

use App\Models\FasilitasModel;
use App\Models\LaporanPerbaikanModel;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;

class FasilitasRepository implements FasilitasRepositoryInterface
{
    public function getAll()
    {
        return FasilitasModel::with('ruangan', 'kategori', 'ruangan.gedung')->get();
    }

    public function create(array $data)
    {
        return FasilitasModel::create($data) ? true : false;
    }

    public function getById($id)
    {
        $fasilitas = FasilitasModel::where('id_fasilitas', $id)->with([
            'ruangan.gedung',
            'kategori',
            'laporan' => function ($query) {
                $query->where('status', '!=', 'selesai');
            }
        ])->first();
        
        if(!$fasilitas) {
            return FasilitasModel::find($id);
        }

        return $fasilitas;
    }

    public function update($id, array $data)
    {
        $fasilitas = FasilitasModel::findOrFail($id);
        return $fasilitas->update($data) ? true : false;
    }

    public function delete($id)
    {
        $fasilitas =  FasilitasModel::findOrFail($id);
        return $fasilitas->delete() ? true : false;
    }

    public function getByRuangan($ruangan)
    {
        return FasilitasModel::where('id_ruangan', $ruangan)->get();
    }

    public function getAllFasilitasByRuangan($id)
    {
        return FasilitasModel::where('id_ruangan', $id)->get();
    }

    private function hasActiveReports($fasilitas)
    {
        $fasilitas = LaporanPerbaikanModel::where('id_fasilitas', $fasilitas->id_fasilitas)
            ->where('status', '!=', 'selesai')
            ->exists();
        
        if($fasilitas) {
            return [ 'status' => 'Sudah ada laporan aktif', 'style' => 'success'];
        }

        return ['status' => 'Tidak ada laporan aktif', 'style' => 'danger'];
    }

    public function search($request)
    {
        $query = FasilitasModel::with([
            'ruangan.gedung',
        ])
            ->when($request->gedung, function ($q) use ($request) {
                $q->whereHas('ruangan', fn($q) => $q->where('id_gedung', $request->gedung));
            })
            ->when($request->ruangan, function ($q) use ($request) {
                $q->where('id_ruangan', $request->ruangan);
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            });

        $fasilitas =  $query->get()->map(function ($fasilitas) {
            return [
                'id' => $fasilitas->id_fasilitas,
                'nama' => $fasilitas->nama,
                'status' => $fasilitas->status,
                'terakhir_update' => $fasilitas->updated_at ? $fasilitas->updated_at->format('d M Y') : 'Belum ada update',
                'dibuat' => $fasilitas->created_at->format('d M Y'),
                'gedung' => $fasilitas->ruangan->gedung ?? null,
                'ruangan' => $fasilitas->ruangan ?? 'Tidak ada ruangan',
                'kategori' => $fasilitas->kategori ?? 'Tidak terkategori',
                'gambar' => $fasilitas->gambar,
                'laporan_count' => $fasilitas->laporan_count ?? 0,
                'memiliki_laporan_aktif' => $this->hasActiveReports($fasilitas)
            ];
        });

        return $fasilitas;
    }
}
