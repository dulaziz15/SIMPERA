<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanModel extends Model
{
    use HasFactory;

    protected $table = 'm_penugasan';
    protected $primaryKey = 'id_penugasan';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'id_teknisi',
        'ditugaskan_oleh',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_progres',
        'catatan_perubahan'
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan');
    }

    public function teknisi()
    {
        return $this->belongsTo(UserModel::class, 'id_teknisi');
    }

    public function penugasanOleh()
    {
        return $this->belongsTo(UserModel::class, 'ditugaskan_oleh');
    }
}