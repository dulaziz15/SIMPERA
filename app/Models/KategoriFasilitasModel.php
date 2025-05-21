<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitasModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori_fasilitas';

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'kode',
        'nama'
    ];

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasModel::class, 'id_kategori_fasilitas');
    }
}
