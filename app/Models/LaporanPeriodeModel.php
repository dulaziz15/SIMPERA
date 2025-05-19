<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPeriodeModel extends Model
{
    use HasFactory;

    protected $table = 'm_laporan_periode';
    protected $primaryKey = 'id_laporan_periode';
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'judul_laporan',
        'tanggal_dibuat',
        'dibuat_oleh',
        'catatan',
        'status'
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }

    public function pembuat()
    {
        return $this->belongsTo(UserModel::class, 'dibuat_oleh');
    }
}
