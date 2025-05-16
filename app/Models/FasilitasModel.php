<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasModel extends Model
{
    use HasFactory;

    protected $table = 'm_fasilitas';
    protected $primaryKey = 'id_fasilitas';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'id_kategori',
        'lokasi',
        'id_gedung',
        'status',
        'created_at',
        'update_at'
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
