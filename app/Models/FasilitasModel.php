<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasModel extends Model
{
    use HasFactory;

    protected $table = 'm_fasilitas';
    protected $primaryKey = 'id_fasilitas';

    protected $fillable = [
        'nama',
        'id_kategori',
        'id_ruangan',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitasModel::class, 'id_kategori');
    }

    public function ruangan()
    {
        return $this->belongsTo(RuanganModel::class, 'id_ruangan');
    }

    public function laporan()
    {
        return $this->hasMany(LaporanPerbaikanModel::class, 'id_fasilitas');
    }
}
