<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGedungModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori_gedung';

    protected $primaryKey = 'id_kategori_gedung';

    protected $fillable = [
        'kategori_gedung'
    ];

    public function gedung()
    {
        return $this->belongsTo(GedungModel::class, 'id_kategori_gedung');
    }
}
