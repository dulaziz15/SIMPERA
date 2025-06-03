<?php

namespace App\Models;

use App\Enums\kerusakan\TingkatKerusakan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendukungLaporanModel extends Model
{
    use HasFactory;

    protected $table = 'm_dukungan_laporan';

    protected $fillable = [
        'id_laporan',
        'id_user',
        'deskripsi',
        'tingkat_kerusakan'
    ];

    protected $casts = [
        'tingkat_kerusakan' => TingkatKerusakan::class,
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
