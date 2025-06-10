<?php

namespace App\Models;

use App\Enums\Status\StatusLaporanPerbaikan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'id_periode',
        'waktu_pelaporan',
        'waktu_perubahan',
        'perkiraan_biaya',
        'kerusakan'
    ];

    public function getStatusAttribute($value)
    {
        return StatusLaporanPerbaikan::from($value);
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasModel::class, 'id_fasilitas');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }

    public function pendukung()
    {
        return $this->hasMany(PendukungLaporanModel::class, 'id_laporan');
    }

    public function firstPendukung()
    {
        return $this->hasOne(PendukungLaporanModel::class, 'id_user', 'id_pengguna')
            ->where('id_user', Auth::user()->id_pengguna);
    }

    public function telahDidukung()
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->pendukung()
            ->where('id_user', Auth::user()->id_pengguna)
            ->exists();
    }

    public function penugasan() {
        return $this->hasOne(PenugasanModel::class, 'id_laporan');
    }

    public function sudahDitugaskan() {
        return $this->penugasan()->exists() ? false : true;
    }
}
