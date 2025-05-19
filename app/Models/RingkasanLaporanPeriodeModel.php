<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RingkasanLaporanPeriodeModel extends Model
{
    use HasFactory;

    protected $table = 'm_ringkasan_laporan_periode';
    protected $primaryKey = 'id_ringkasan';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan_periode',
        'total_laporan',
        'total_selesai',
        'total_dalam_proses',
        'total_tertunda',
        'rata_rata_waktu_penyelesaian',
        'fasilitas_paling_sering',
        'teknisi_paling_aktif',
        'total_biaya',
        'persentase_penyelesaian',
    ];

    public function laporanPeriode()
    {
        return $this->belongsTo(LaporanPeriodeModel::class, 'id_laporan_periode');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasModel::class, 'fasilitas_paling_sering');
    }

    public function teknisi()
    {
        return $this->belongsTo(UserModel::class, 'teknisi_paling_aktif');
    }
}
