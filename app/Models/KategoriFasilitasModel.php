<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitasModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_fasilitas';

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'kode',
        'nama'
    ];
}
