<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikLaporanModel extends Model
{
     use HasFactory;

    protected $table = 'm_statistik_laporan';
    protected $primaryKey = 'id_statistik';
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'total_laporan',
        'laporan_selesai',
        'rata_waktu_penyelesaian',
        'fasilitas_paling_sering',
        'waktu_pembuatan'
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasModel::class, 'fasilitas_paling_sering');
    }
}