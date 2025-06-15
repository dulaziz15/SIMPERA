<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivityModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'm_log_aktivitas';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_pengguna',
        'jenis_aktivitas',
        'deskripsi',
        'waktu'
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
