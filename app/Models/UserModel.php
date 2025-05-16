<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;

    protected $fillable = [
        'nama_pengguna',
        'hash_kata_sandi',
        'id_peran',
        'surel',
        'nama_lengkap',
        'created_at',
        'update_at'
    ];

    public function peran()
    {
        return $this->belongsTo(PeranModel::class, 'id_peran');
    }
}