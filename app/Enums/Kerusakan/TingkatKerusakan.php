<?php

namespace App\Enums\kerusakan;

enum TingkatKerusakan: string
{
    case RINGAN = '1';
    case SEDANG = '2';
    case BERAT = '3';

    public function label(): string
    {
        return match ($this) {
            self::RINGAN => 'Ringan',
            self::SEDANG => 'Sedang',
            self::BERAT => 'Berat',
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
            self::RINGAN => 'primary',
            self::SEDANG => 'warning',
            self::BERAT => 'danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::RINGAN => 'fas fa-circle-check',
            self::SEDANG => 'fas fa-exclamation-triangle',
            self::BERAT => 'fas fa-skull-crossbones',
        };
    }
}