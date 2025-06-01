<?php

namespace App\Enums\Peran;

enum PeranEnums: string
{
    case ADMIN = 'ADM';           // Admin
    case SARANA_PRASARANA = 'SPS'; // Sarana Prasarana
    case TEKNISI = 'TKNS';        // Teknisi
    case DOSEN = 'DSN';           // Dosen
    case TENAGA_KEPENDIDIKAN = 'TDK'; // Tenaga Kependidikan
    case MAHASISWA = 'MHS';       // Mahasiswa

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::SARANA_PRASARANA => 'Sarana Prasarana',
            self::TEKNISI => 'Teknisi',
            self::DOSEN => 'Dosen',
            self::TENAGA_KEPENDIDIKAN => 'Tenaga Kependidikan',
            self::MAHASISWA => 'Mahasiswa',
        };
    }
    
    public function kelompok(): string
    {
        return match($this) {
            self::ADMIN => 'admin',
            self::SARANA_PRASARANA => 'sarpras',
            self::TEKNISI => 'teknisi',
            self::DOSEN, self::TENAGA_KEPENDIDIKAN, self::MAHASISWA => 'user',
        };
    }
    
    public function isUser(): bool
    {
        return $this->kelompok() === 'user';
    }
    
    public function isAdmin(): bool
    {
        return $this->kelompok() === 'admin';
    }
    
    public function isSarpras(): bool
    {
        return $this->kelompok() === 'sarpras';
    }
    
    public function isTeknisi(): bool
    {
        return $this->kelompok() === 'teknisi';
    }
}