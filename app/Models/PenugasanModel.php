<?php

namespace App\Models;

use App\Enums\Status\StatusPenugasan;
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

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // public function status($value)
    // {
    //     return StatusPenugasan::from($value);
    // }

    public function laporan()
    {
        return $this->belongsTo(LaporanPerbaikanModel::class, 'id_laporan');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'id_teknisi');
    }

    public function sarpras()
    {
        return $this->belongsTo(User::class, 'ditugaskan_oleh');
    }

    public function penugasan()
    {
        return $this->belongsTo(UserModel::class, 'ditugaskan_oleh');
    }

    public function durasi()
    {
        if (!$this->tanggal_mulai || !$this->tanggal_selesai) {
            return 'Belum ditentukan';
        }

        $days = $this->tanggal_mulai->diffInDays($this->tanggal_selesai);

        return $days > 0 ?
            "$days" :
            "Kurang dari 1 hari";
    }
}
