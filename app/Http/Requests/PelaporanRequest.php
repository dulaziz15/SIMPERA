<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelaporanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // Atur sesuai kebijakan auth‑mu
    }

    public function rules(): array
    {
        // Aturan dasar (‐selalu dibutuhkan)
        $rules = [
            'id_pengguna'      => 'required',
            'id_fasilitas'     => 'required',
            'deskripsi'        => 'required',
            'status'           => 'required',
            'waktu_pelaporan'  => 'required|date',
            'waktu_perubahan'  => 'required|date',
        ];

        // Deteksi apakah ini create (POST) atau update (PUT/PATCH)
        $isCreate = $this->isMethod('post');

        // Tambahkan aturan untuk url_foto sesuai kasus
        $rules['url_foto'] = ($isCreate ? 'required' : 'nullable')
            . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }

    /**
     * Opsi: ubah pesan error biar lebih jelas
     */
    public function messages(): array
    {
        return [
            'url_foto.required' => 'Foto fasilitas wajib diunggah saat membuat pelaporan.',
            'url_foto.image'    => 'File foto harus berupa gambar JPEG, PNG, JPG, GIF, atau SVG.',
        ];
    }
}
