<?php

namespace App\Enums\Status;

enum StatusLaporanPerbaikan: string
{
    case BARU = 'baru';
    case DIAJUKAN = 'diajukan';
    case VERIFIKASI = 'diverifikasi';
    case PERBAIKAN = 'diperbaiki';
    case REJECT = 'ditolak';
    case SELESAI = 'selesai';

    public function label(): string
    {
        return match ($this) {
            self::BARU => 'Baru',
            self::DIAJUKAN => 'Diajukan',
            self::VERIFIKASI => 'Diverifikasi',
            self::PERBAIKAN => 'Sedang Diperbaiki',  // Fixed typo from "esdang"
            self::REJECT => 'Ditolak',
            self::SELESAI => 'Selesai'
        };
    }

    public function badge(): string
    {
        return sprintf(
            '<span class="badge bg-%s bg-opacity-15 text-white border border-%s border-opacity-25">%s</span>',
            $this->color(),
            $this->color(),
            $this->color(),
            $this->label()
        );
    }

    public function color(): string
    {
        return match ($this) {
            self::BARU => 'primary',
            self::DIAJUKAN => 'secondary',
            self::VERIFIKASI => 'info',
            self::PERBAIKAN => 'warning',
            self::REJECT => 'danger',
            self::SELESAI => 'success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::BARU => 'fa-clock',
            self::DIAJUKAN => 'fa-timae-circle',
            self::VERIFIKASI => 'fa-check-circle',
            self::PERBAIKAN => 'fa-tools',
            self::REJECT => 'fa-times-circle',
            self::SELESAI => 'fa-check-double',
        };
    }

    public function isFinal(): bool
    {
        return match ($this) {
            self::VERIFIKASI, self::PERBAIKAN, self::SELESAI => true,
            default => false,
        };
    }
}