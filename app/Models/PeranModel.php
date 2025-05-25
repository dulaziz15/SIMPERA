<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeranModel extends Model
{
    use HasFactory;

    protected $table = 'm_peran';

    protected $primaryKey = 'id_peran';

    protected $fillable = [
        'kode_peran',
        'nama'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_peran');
    }
}
