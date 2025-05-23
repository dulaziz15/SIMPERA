<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validasi Gagal. Harap periksa kembali data Anda.',
            'msgField' => $validator->errors()
        ], 422));
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'nama_pengguna' => 'required|string|min:3|max:20',
            'hash_kata_sandi' => $isUpdate ? 'nullable|string|min:5|max:20' : 'required|string|min:5|max:20',
            'id_peran' => 'required|integer|exists:m_peran,id_peran',
            'surel' => $isUpdate ? 'required|email' : 'required|email|unique:m_user,surel'
        ];
    }
}
