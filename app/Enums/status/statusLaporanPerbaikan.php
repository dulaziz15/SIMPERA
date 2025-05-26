<?php  

namespace App\Enums\Status;

enum statusLaporanPerbaikan {
    const BARU = 'baru';
    const VERIFIKASI = 'diverifikasi';
    const PERBAIKI = 'diperbaiki';
    const REJECT = 'ditolak';
    const SELESAI = 'selesai';
}