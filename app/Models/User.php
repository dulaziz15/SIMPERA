<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'm_user';
    protected $primaryKey = 'id_pengguna';
    protected $hidden = ['hash_kata_sandi'];

    protected $casts = ['hash_kata_sandi' => 'hashed'];

    protected $fillable = [
        'nama_pengguna',
        'hash_kata_sandi',
        'id_peran',
        'surel',
        'nama_lengkap'
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

    public function getPeranName() {
        return $this->peran->nama;
    }

    public function hasPeran($peran) {
        return $this->peran->kode_peran == $peran;
    }

    public function getPeran() {
        return $this->peran->kode_peran;
    }
}
