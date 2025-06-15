<?php

namespace App\Repositories\Implementations;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Models\LaporanPerbaikanModel;
use App\Models\PeriodeModel;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PelaporanRepository implements PelaporanRepositoryInterface
{
    public function getAll()
    {
        return LaporanPerbaikanModel::where('perkiraan_biaya', '!=', null)->orWhere('kerusakan', '!=', null)->with(['periode', 'fasilitas', 'pengguna'])->get();
    }

    public function all()
    {
        return LaporanPerbaikanModel::with(['periode', 'fasilitas', 'pengguna'])->get();
    }

    public function getByPeriode()
    {
        $today = Carbon::now();

        $periode = PeriodeModel::whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->first();

        if (!$periode) {
            return collect();
        }

        return LaporanPerbaikanModel::where('id_periode', $periode->id_periode)->get();
    }

    public function getLaporanPerPeriode()
    {
        $laporan = LaporanPerbaikanModel::select('id_periode', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('id_periode')
            ->with([
                'periode:id_periode,nama',
                'periode.laporan' => function ($query) {
                    $query->select('id_periode', 'id_periode', 'status');
                }
            ])
            ->get();

        return $laporan->map(function ($item) {
            $laporanPerPeriode = $item ?? collect();

            return [
                'id_periode'      => $item->id_periode,
                'nama_periode'    => $item->periode->nama ?? 'Tanpa Nama',
                'jumlah_laporan'  => $item->jumlah,
                'baru'            => $laporanPerPeriode->where('status', StatusLaporanPerbaikan::BARU)->where('id_periode', $item->id_periode)->count(),
                'diverifikasi'    => $laporanPerPeriode->where('status', StatusLaporanPerbaikan::VERIFIKASI)->where('id_periode', $item->id_periode)->count(),
                'diajukan'        => $laporanPerPeriode->where('status', StatusLaporanPerbaikan::DIAJUKAN)->where('id_periode', $item->id_periode)->count(),
                'perbaikan'       => $laporanPerPeriode->where('status', StatusLaporanPerbaikan::PERBAIKAN)->where('id_periode', $item->id_periode)->count(),
                'selesai'         => $laporanPerPeriode->where('status', StatusLaporanPerbaikan::SELESAI)->where('id_periode', $item->id_periode)->count(),
            ];
        });
    }


    public function getLaporanSering($startDate = null, $endDate = null)
    {
        $query = LaporanPerbaikanModel::query();

        if ($startDate && $endDate) {
            $query->whereBetween('waktu_pelaporan', [$startDate, $endDate . ' 23:59:59']);
        }

        return $query->withCount('pendukung')
            ->where('status', '!=', StatusLaporanPerbaikan::SELESAI)
            ->whereHas('fasilitas')
            ->with('fasilitas')
            ->get()
            ->groupBy('id_fasilitas')
            ->map(function ($group) {
                return [
                    'id_fasilitas' => $group->first()->id_fasilitas,
                    'total' => $group->sum('pendukung_count'),
                    'fasilitas' => $group->first()->fasilitas,
                ];
            })
            ->sortByDesc('total')
            ->values();
    }

    public function getBiayaPerbaikan()
    {
        $today = Carbon::now();

        $periode = PeriodeModel::whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->first();

        if (!$periode) {
            return collect();
        }

        return LaporanPerbaikanModel::where('id_periode', $periode->id_periode)
            ->where('status', '!=', StatusLaporanPerbaikan::SELESAI)
            ->whereNotNull('perkiraan_biaya')
            ->orderByDesc('perkiraan_biaya')
            ->get();
    }

    public function getLaporanSeringThisPeriode()
    {
        $today = Carbon::now();

        $periode = PeriodeModel::whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->first();

        if (!$periode) {
            return collect();
        }

        return LaporanPerbaikanModel::where('id_periode', $periode->id_periode)
            ->where('status', '!=', StatusLaporanPerbaikan::SELESAI)
            ->whereHas('fasilitas')
            ->with(['fasilitas'])
            ->withCount('pendukung')
            ->get()
            ->groupBy('id_fasilitas')
            ->map(function ($laporan) {
                return [
                    'fasilitas' => $laporan->first()->fasilitas,
                    'laporan'   => $laporan,
                    'total'     => $laporan->sum('pendukung_count'),
                ];
            })
            ->sortByDesc('total')
            ->values();
    }


    public function getAllPeninjauan()
    {
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

    public function getPendukungByLaporan($id)
    {
        return LaporanPerbaikanModel::find($id)->pendukung()->get();
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
        return LaporanPerbaikanModel::query()
            ->with([
                'pendukung' => function ($query) use ($id) {
                    $query->where('id_user', $id);
                },
                'fasilitas',
                'feedback'
            ])
            ->whereHas('pendukung', function ($query) use ($id) {
                $query->where('id_user', $id);
            })
            ->where('status', StatusLaporanPerbaikan::SELESAI->value)
            ->orderByDesc('waktu_pelaporan')
            ->get();
    }

    public function updateStatus($id, $status)
    {
        return LaporanPerbaikanModel::find($id)->update($status) ? true : false;
    }
}
