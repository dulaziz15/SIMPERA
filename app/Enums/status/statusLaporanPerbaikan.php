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
    public function badge(): string
    {
        return match ($this) {
            self::BARU => '<span class="badge bg-primary">Baru</span>',
            self::VERIFIKASI => '<span class="badge bg-info">Diverifikasi</span>',
            self::PERBAIKAN => '<span class="badge bg-warning">Sedang Diperbaiki</span>',
            self::REJECT => '<span class="badge bg-danger">Ditolak</span>',
            self::SELESAI => '<span class="badge bg-success">Selesai</span>',
        };
    }
}
