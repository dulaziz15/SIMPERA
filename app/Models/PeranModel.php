<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeranModel extends Model
{
    use HasFactory;

    protected $table = 'peran';

    protected $primaryKey = 'id_peran';

    protected $fillable = [
        'kode',
        'nama'
    ];
}
