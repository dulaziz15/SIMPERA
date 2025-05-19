<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporanModel extends Model
{
    use HasFactory;

    protected $table = 'm_detail_laporan_periode';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan_periode',
        'id_laporan_perbaikan',
        'id_penugasan',
        'waktu_pelaporan',
        'waktu_penyelesaian',
        'durasi_penyelesaian',
        'biaya_perbaikan',
        'materi_perbaikan',
        'catatan_khusus',
    ];

    public function laporanPeriode()
    {
        return $this->belongsTo(LaporanPeriodeModel::class, 'id_laporan_periode');
    }

    public function laporanPerbaikan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan_perbaikan');
    }

    public function penugasan()
    {
        return $this->belongsTo(PenugasanModel::class, 'id_penugasan');
    }
}
