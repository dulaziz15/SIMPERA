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

    public function search($request)
    {
        return $this->userRepository->search($request);
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
        $fotoPath = $this->fotoHandler($request);

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
        $imageName = null;
        if ($foto->hasFile('foto_profil')) {
            $url_foto = $foto->file('foto_profil');
            $imageName = time() . '_' . $url_foto->getClientOriginalName();
            $url_foto->storeAs('uploads/profil', $imageName, 'public');
        }

        return $imageName;
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
