@extends('layouts.app') <!-- Menggunakan layout utama dari folder layouts/template.blade.php -->

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3> <!-- Menampilkan judul halaman dari variabel $page -->
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form action="{{ url('kegiatan') }}" method="POST"> <!-- Form untuk menyimpan data UKM baru -->
                @csrf <!-- Token CSRF untuk keamanan form -->

                <!-- Input untuk Nama UKM -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama UKM</label>
                    <div class="col-11">
                        <select class="form-control" id="ukm_id" name="ukm_id" required>
                            <option value="">- Pilih UKM -</option>
                            @foreach($ukm as $item)
                                <option value="{{ $item->ukm_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('ukm_id') <!-- Menampilkan pesan error jika validasi gagal -->
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Input untuk Nama Kegiatan -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Kegiatan</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
                        @error('nama_kegiatan') <!-- Menampilkan pesan error jika validasi gagal -->
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Input untuk Tanggal Kegiatan -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Deskripsi Kegiatan</label>
                    <div class="col-11">
                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control"></textarea>
                        @error('deskripsi_kegiatan') <!-- Menampilkan pesan error jika validasi gagal -->
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('kegiatan_ukm') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection