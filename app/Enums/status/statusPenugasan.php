<?php

namespace App\Enums\Status;

enum statusPenugasan: string
{
    case DITUGASKAN = 'ditugaskan';
    case PROSES = 'proses';
    case SELESAI = 'selesai';

    public function label(): string
    {
        return match ($this) {
            self::DITUGASKAN => 'Ditugaskan',
            self::PROSES => 'Proses',
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
            self::DITUGASKAN => 'danger',
            self::PROSES => 'warning',
            self::SELESAI => 'success'
        };
    }
}
