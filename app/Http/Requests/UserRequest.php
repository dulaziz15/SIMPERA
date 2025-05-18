<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest{
    public function rules() {
        return [
            'nama_pengguna' => 'required|string',
            'hash_kata_sandi' => 'required|string',
            'id_peran' => 'required|int',
            'surel' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required|string',
        ];
    }
}