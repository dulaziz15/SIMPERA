<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
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
        'created_at',
        'update_at'
    ];

    public function pengguna()
    {
        return $this->belongsTo(UserModel::class, 'id_pengguna');
    }
}