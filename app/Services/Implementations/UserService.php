<?php

namespace App\Services\Implementations;

use App\Http\Requests\ProfilRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function countUserByPeran()
    {
        $peran = $this->getAll();

        foreach ($peran as $p) {
            $jumlahPeran[$p->level_nama] = $this->userRepository->countUserByPeran($p->id_peran);
        }

        return $jumlahPeran;
    }

    public function createUser(UserRequest $request)
    {
        return $this->userRepository->storeUser([
            'nama_pengguna' => $request->nama_pengguna,
            'hash_kata_sandi' => $request->hash_kata_sandi,
            'id_peran' => $request->id_peran,
            'surel' => $request->surel
        ]);
    }

    public function createProfil(ProfilRequest $request, $id)
    {
        $fotoPath = $this->fotoHandler($request->file('foto_profil'));

        $profil = $this->userRepository->storeProfil([
            'id_pengguna' => $id, // or get from $request if needed
            'nama_lengkap' => $request->nama_lengkap,
            'aktif' => now()->toDateString(),
            'foto_profil' => $fotoPath,
        ]);

        return $profil;
    }

    public function fotoHandler($foto, $fotoLama = null)
    {
        // Jika tidak ada file baru diupload, kembalikan foto lama
        if (!$foto) {
            return $fotoLama;
        }

        // Hapus foto lama jika ada
        if ($fotoLama && Storage::disk('public')->exists($fotoLama)) {
            Storage::disk('public')->delete($fotoLama);
        }

        // Simpan foto baru
        $path = $foto->store('foto_profil', 'public');
        return $path;
    }

    public function updateProfile($id, UserRequest $request)
    {
        return $this->userRepository->update($id, [
            'nama_pengguna' => $request->nama_pengguna,
            'hash_kata_sandi' => $request->hash_kata_sandi,
            'id_peran' => $request->id_peran,
            'surel' => $request->surel
        ]);
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUserByPeran($peran)
    {
        return $this->userRepository->getUserByPeran($peran);
    }

    // public function getUserByNama($nama) {

    // }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
