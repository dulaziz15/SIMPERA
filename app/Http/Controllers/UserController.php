<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\Interfaces\UserServiceInterface;

class UserController extends Controller
{
    protected $userServiceInterface;

    public function __construct(UserServiceInterface $userServiceInterface) {
        $this->userServiceInterface = $userServiceInterface;
    }

    public function index() {
        return view('user.index');
    }

    public function create() {
        return view('user.create');
    }

    public function storeUser(UserRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->userServiceInterface->createUser($request);
            if($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/user')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/user')
                ]);
            }
        }

        return redirect('/user');
    }

    public function edit($id) {
        $user = $this->userServiceInterface->getUserById($id);
        return view('user.edit', compact('user'));
    }

    public function updateProfile($id, UserRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->userServiceInterface->updateProfile($id, $request);
            if($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/user')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/user')
                ]);
            }
        }

        return redirect('/user');
    }

    public function show($id) {
        $user = $this->userServiceInterface->getUserById($id);
        return view('user.show', compact('user'));
    }

    public function confirmDelete($id) {
        $user = $this->userServiceInterface->getUserById($id);
        return view('user.confirm', compact('user'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $user = $this->userServiceInterface->deleteUser($id);
            if($user) {
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
