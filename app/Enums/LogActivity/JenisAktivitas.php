<?php  

namespace App\Enums\LogActivity;

enum JenisAktivitas {
    const MENAMBAH = "Menambah";
    const MENGUBAH = 'Mengubah';
    const MENGHAPUS = 'Menghapus';
    const LOGIN = 'Login';
    const LOGOUT = 'logout';
    const PENGAJUAN = 'Pengajuan';
    const VERIFIKASI = 'Verifikasi';
    const PENUGASAN = 'Penugasan';
    const SELESAI = 'Penyelesaian';
}