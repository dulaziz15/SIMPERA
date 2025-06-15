<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\PeranRequest;
use App\Models\PeranModel;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\PeranServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;



class PeranController extends Controller
{
    protected $peranService;
    protected $logService;
    public function __construct(PeranServiceInterface $peranService, LogActivityServiceInterface $logService){
        $this->peranService = $peranService;
        $this->logService = $logService;
    }

    public function index() {
        $peran = $this->peranService->getAll();

        $activeMenu = 'peran';

        $breadcrumb = (object)[
            'title' => 'User Roles',
            'list' => ['Data Master', 'Roles']
        ];

        return view('peran.index', compact('peran', 'breadcrumb', 'activeMenu'));
    }

    public function create() {
        return view('peran.create');
    }

    public function getAll()
    {
        $userService = $this->peranService;

        $data = $userService->getAll();

        return DataTables::of(collect($data))->make(true);
    }

    public function show($id) {
        $peran = $this->peranService->show($id);
        return view('peran.show', compact('peran'));
    }

    public function storePeran(PeranRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $peran = $this->peranService->storePeran($request);
            if($peran) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENAMBAH, 'Menambah data peran baru', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }

    public function edit($id) {
        $peran = $this->peranService->show($id);
        return view('peran.edit', compact('peran'));
    }

    public function update($id, PeranRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $peran = $this->peranService->edit($id, $request);
            if($peran) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah data peran dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }

    public function confirm($id) {
        $peran = $this->peranService->show($id);
        return view('peran.confirm', compact('peran'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
                    // Get the currently logged-in user
        $user = Auth::user();

        // Check if the user's role matches the role to be deleted
        if ($user && $user->id_peran == $id) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak dapat menghapus peran yang sedang digunakan oleh user yang sedang aktif.',
            ]);
        }

            $peran = $this->peranService->delete($id);
            if($peran) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGHAPUS, 'Menghapus data peran dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }
}
