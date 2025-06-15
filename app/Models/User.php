<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Peran\PeranEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'id_pengguna';
    protected $hidden = ['hash_kata_sandi'];

    protected $casts = ['hash_kata_sandi' => 'hashed'];

    protected $fillable = [
        'nama_pengguna',
        'hash_kata_sandi',
        'id_peran',
        'surel'
    ];

    public function getAuthPassword()
    {
        return $this->hash_kata_sandi;
    }


    public function getAuthIdentifierName()
    {
        return 'id_pengguna';
    }

    public function peran()
    {
        return $this->belongsTo(PeranModel::class, 'id_peran');
    }

    public function getPeranName()
    {
        return $this->peran->nama;
    }

    public function hasPeran($peran)
    {
        return $this->peran->kode_peran == $peran;
    }

    public function getPeran()
    {
        return $this->peran->kode_peran;
    }

    public function profil()
    {
        return $this->hasOne(ProfilModel::class, 'id_pengguna');
    }

    public function pendukung() {
        return $this->belongsTo(PendukungLaporanModel::class, 'id_user');
    }

    public function laporan()
    {
        return $this->hasMany(LaporanPerbaikanModel::class, 'id_pengguna');
    }

    public function penugasan() {
        return $this->belongsTo(PenugasanModel::class, 'id_pengguna');
    }

    public function isAdmin(): bool
    {
        return $this->peran->kode_peran == PeranEnums::ADMIN->value ? true : false;
    }

    public function isSarpras(): bool
    {
        return ($this->peran->kode_peran == PeranEnums::SARANA_PRASARANA->value) ? true : false;
    }

    public function isTeknisi(): bool
    {
        return $this->peran->kode_peran == PeranEnums::TEKNISI->value ? true : false;
    }

    public function isUser(): bool
    {
        return in_array($this->peran->kode_peran, [
            PeranEnums::DOSEN->value,
            PeranEnums::TENAGA_KEPENDIDIKAN->value,
            PeranEnums::MAHASISWA->value
        ]);
    }

    public function log()
    {
        return $this->hasMany(LogActivityModel::class, 'id_pengguna');
    }
}
