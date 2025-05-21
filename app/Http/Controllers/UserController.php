<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\Interfaces\PeranServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userServiceInterface;
    protected $peranService;

    public function __construct(
        UserServiceInterface $userServiceInterface,
        PeranServiceInterface $peranService
    ) {
        $this->userServiceInterface = $userServiceInterface;
        $this->peranService = $peranService;
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar User yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';
        $peran = $this->peranService->getAll();
        $user = $this->userServiceInterface->getAll();
        // $jumlahPeran = $this->userServiceInterface->countUserByPeran();

        // dd($jumlahPeran);
        return view('user.index', compact('peran', 'breadcrumb', 'page', 'activeMenu', 'user'));
    }

    public function getAll(Request $request)
    {
        $userService = $this->userServiceInterface;

        if ($request->id_peran) {
            $userData = $userService->getUserByPeran($request->id_peran);
        } else {
            $userData = $userService->getAll();
        }

        return DataTables::of($userData)->make(true);
    }


    public function create()
    {
        $peran = $this->peranService->getAll();
        return view('user.create', compact('peran'));
    }

    public function storeUser(UserRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->userServiceInterface->createUser($request);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.'
                ]);
            }
        }

        return redirect('/user');
    }

    public function edit($id)
    {
        $user = $this->userServiceInterface->getUserById($id);
        $peran = $this->peranService->getAll();
        return view('user.edit', compact('user', 'peran'));
    }

    public function updateProfile($id, UserRequest $request)
    {
        if (!($request->ajax() || $request->wantsJson())) {
            return redirect('/user');
        }


        if (empty($request['hash_kata_sandi'])) {
            $userData = $this->userServiceInterface->getUserById($id);
            $request['hash_kata_sandi'] = $userData->hash_kata_sandi;
        }

        $updated = $this->userServiceInterface->updateProfile($id, $request);

        return response()->json([
            'status' => (bool) $updated,
            'message' => $updated ? 'Data berhasil diupdate.' : 'Data gagal diupdate.',
            'redirect' => url('/user')
        ]);
    }


    public function show($id)
    {
        $user = $this->userServiceInterface->getUserById($id);
        return view('user.show', compact('user'));
    }

    public function confirmDelete($id)
    {
        $user = $this->userServiceInterface->getUserById($id);
        return view('user.confirm', compact('user'));
    }

    public function delete($id, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->userServiceInterface->deleteUser($id);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/user')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/user')
                ]);
            }
        }

        return redirect('/user');
    }
}
