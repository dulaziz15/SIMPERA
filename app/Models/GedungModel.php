<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GedungModel extends Model
{
    use HasFactory;

    protected $table = 'gedung';

    protected $primaryKey = 'id_gedung';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi'
    ];
}
