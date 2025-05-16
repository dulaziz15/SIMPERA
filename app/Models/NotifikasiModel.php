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
        'id_pengguna',
        'judul',
        'pesan',
        'sudah_dibaca',
        'created_at'
    ];

    public function pengguna()
    {
        return $this->belongsTo(UserModel::class, 'id_pengguna');
    }
}
