<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerbaikanModel extends Model
{
    use HasFactory;

    protected $table = 'm_riwayat_perbaikan';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'tindakan_dilakukan',
        'material_dipakai',
        'biaya',
        'diperbaiki_oleh',
        'tanggal_perbaikan'
    ];

    public function laporanPerbaikan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan');
    }

    public function teknisi()
    {
        return $this->belongsTo(UserModel::class, 'diperbaiki_oleh');
    }
}
