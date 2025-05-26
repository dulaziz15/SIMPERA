<?php

namespace App\Enums\Status;

enum StatusLaporanPerbaikan: string
{
    case BARU = 'baru';
    case VERIFIKASI = 'diverifikasi';
    case PERBAIKAN = 'diperbaiki';
    case REJECT = 'ditolak';
    case SELESAI = 'selesai';
    
    public static function labels(): array
    {
        return [
            self::BARU->value => 'baru',
            self::VERIFIKASI->value => 'diverifikasi',
            self::PERBAIKAN->value => 'esdang diperbaiki',
            self::REJECT->value => 'ditolak',
            self::SELESAI->value => 'selesai'
        ];
    }
}