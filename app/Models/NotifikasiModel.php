<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiModel extends Model
{
     use HasFactory;

    protected $table = 'm_notifikasi';
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'id_pengguna',
        'judul',
        'pesan',
        'sudah_dibaca',
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(UserModel::class, 'id_pengguna');
    }

    public function laporan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan');
    }
}
