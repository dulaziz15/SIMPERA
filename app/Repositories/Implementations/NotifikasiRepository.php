<?php  

namespace App\Repositories\Implementations;

use App\Models\NotifikasiModel;
use App\Repositories\Interfaces\NotifikasiRepositoryInterface;

class NotifikasiRepository implements NotifikasiRepositoryInterface
{
    public function create($laporan, $judul, $pesan)
    {
        // Then create notifications for all supporters
        foreach ($laporan->pendukung as $pendukung) {
            $create = NotifikasiModel::create([
                'id_laporan' => $laporan->id_laporan,
                'id_pengguna' => $pendukung->id_user,
                'judul' => $judul,
                'pesan' => $pesan,
                'sudah_dibaca' => 0,
            ]);
            if (!$create) {
                return false; 
            }
        }

        return true;
    }

    public function updateRead($id)
    {
        return NotifikasiModel::find($id)->update(['sudah_dibaca' => 1]) ? true : false; // Save the changes
    }
}