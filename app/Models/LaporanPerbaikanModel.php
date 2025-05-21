<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPerbaikanModel extends Model
{
    use HasFactory;

    protected $table = 'm_laporan_perbaikan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_fasilitas',
        'deskripsi',
        'url_foto',
        'status',
        'id_periode'
    ];

    public function pengguna()
    {
        return $this->belongsTo(UserModel::class, 'id_pengguna');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasModel::class, 'id_fasilitas');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }
}