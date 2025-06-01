<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FasilitasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nama' => 'required',
            'id_kategori' => 'required',
            'id_ruangan' => 'required',
            'status' => 'required|string'
        ];

        // Deteksi apakah ini create (POST) atau update (PUT/PATCH)
        $isCreate = $this->isMethod('post');

        // // Tambahkan aturan untuk url_foto sesuai kasus
        $rules['gambar'] = ($isCreate ? 'required' : 'nullable')
            . '|file|mimes:jpeg,png,jpg,gif,svg';

        return $rules;
    }
}
