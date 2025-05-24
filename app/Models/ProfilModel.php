<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilModel extends Model
{
    use HasFactory;

    protected $table = 'm_profil';
    protected $primaryKey = 'id_profil';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'nama_lengkap',
        'aktif',
        'foto_profil',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}