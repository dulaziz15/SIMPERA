@extends('layouts.app') <!-- Meng-extend template utama -->

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3> <!-- Menampilkan judul halaman -->
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <!-- Menampilkan pesan error jika ada -->
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Menampilkan pesan jika data kegiatan UKM tidak ditemukan -->
            @empty($kegiatan_ukm)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kegiatan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <!-- Form untuk mengedit data kegiatan UKM -->
                <form action="{{ url('kegiatan/' . $kegiatan_ukm->kegiatan_id) }}" method="POST" class="form-horizontal">
                    @csrf <!-- Token CSRF untuk keamanan -->
                    {!! method_field('PUT') !!} <!-- Menggunakan metode PUT untuk update data -->

                    <!-- Input untuk memilih UKM -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama UKM</label>
                        <div class="col-11">
                            <select class="form-control" id="ukm_id" name="ukm_id" required>
                                <option value="">- Pilih UKM -</option>
                                @foreach($ukm as $item)
                                    <option value="{{ $item->ukm_id }}" @if($item->ukm_id == $kegiatan_ukm->ukm_id) selected @endif>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        @error('ukm_id') <!-- Menampilkan pesan error jika validasi gagal -->
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>

                    <!-- Input untuk nama kegiatan UKM -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama Kegiatan</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama', $kegiatan_ukm->nama_kegiatan) }}" required>
                            @error('nama_kegiatan') <!-- Menampilkan pesan error jika validasi gagal -->
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Input untuk deskripsi kegiatan UKM -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Deskripsi Kegiatan</label>
                        <div class="col-11">
                            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" required>{{ $kegiatan_ukm->deskripsi_kegiatan }}</textarea>
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
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('kegiatan') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection