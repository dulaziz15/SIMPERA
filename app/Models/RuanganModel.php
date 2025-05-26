<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganModel extends Model
{
    use HasFactory;

    protected $table = 'm_ruangan';

    protected $primaryKey = 'id_ruangan';

    protected $fillable = [
        'id_gedung',
        'kode',
        'nama',
        'lantai',
        'deskripsi'
    ];

    public function gedung() {
        return $this->belongsTo(GedungModel::class, 'id_gedung');
    }
}
