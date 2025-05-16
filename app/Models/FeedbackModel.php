<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
     use HasFactory;

    protected $table = 'm_feedback';
    protected $primaryKey = 'id_feedback';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'id_laporan',
        'penilaian',
        'komentar',
        'created_at'
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