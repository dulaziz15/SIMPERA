<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GedungModel extends Model
{
    use HasFactory;

    protected $table = 'm_gedung';

    protected $primaryKey = 'id_gedung';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'id_kategori_gedung'
    ];

    public function kategori_gedung()
    {
        return $this->belongsTo(KategoriGedungModel::class, 'id_kategori_gedung');
    }
}
