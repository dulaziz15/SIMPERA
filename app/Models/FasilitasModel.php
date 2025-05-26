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
        'lokasi',
        'id_gedung',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitasModel::class, 'id_kategori');
    }

    public function gedung()
    {
        return $this->belongsTo(GedungModel::class, 'id_gedung');
    }
}
