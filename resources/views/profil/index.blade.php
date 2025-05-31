@extends('layout.app')

@section('content')
    <div class="card p-6">
        <div class="card-body">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-lg-4 align-self-center">
                        <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="advisor_thumb">
                                <img src="{{ asset('storage/foto_profil/' . $profil->profil->foto_profil) }}" alt=""
                                    style="width: 100%">

                                <a onclick="modalUpdateImage('{{ $profil->profil->id_profil }}')" class="btn-edit-foto"
                                    title="Edit Foto">
                                    <i class="fa fa-camera"></i>
                                </a>
                            </div>
                            <div class="single_advisor_details_info">
                                <h6>{{ $profil->nama_pengguna }}</h6>
                                <p class="designation">{{ $profil->peran->nama }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 align-self-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Informasi Lengkap</h5>
                                <hr>
                                <table class="table table-borderless">
                                    <tr>
                                        <th style="width: 200px;">Nama Lengkap</th>
                                        <td>{{ $profil->profil->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <td>{{ $profil->nama_pengguna }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $profil->surel }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Role</th>
                                        <td>{{ $profil->peran->kode_peran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>{{ $profil->peran->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Bergabung</th>
                                        <td>{{ $profil->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                                <a href="" class="btn btn-primary mt-2">
                                    <i class="fa fa-edit"></i> Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('profil.component.modal_update_image')
@endsection

@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .btn-edit-foto {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            /* Sama */
            height: 36px;
            /* Sama */
            background-color: #ffffffcc;
            color: #3f43fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 2;
            transition: background 0.3s, color 0.3s;
        }

        .btn-edit-foto:hover {
            background-color: #3f43fd;
            color: white;
        }

        .single_advisor_profile {
            position: relative;
            margin-bottom: 50px;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            z-index: 1;
            border-radius: 15px;
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        }

        .single_advisor_profile .advisor_thumb {
            position: relative;
            z-index: 1;
            border-radius: 15px 15px 0 0;
            margin: 0 auto;
            padding: 30px 30px 0 30px;
            background-color: #3f43fd;
            overflow: hidden;
        }

        .single_advisor_profile .advisor_thumb::after {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            position: absolute;
            width: 150%;
            height: 80px;
            bottom: -45px;
            left: -25%;
            content: "";
            background-color: #ffffff;
            -webkit-transform: rotate(-15deg);
            transform: rotate(-15deg);
        }

        @media only screen and (max-width: 575px) {
            .single_advisor_profile .advisor_thumb::after {
                height: 160px;
                bottom: -90px;
            }
        }

        .single_advisor_profile .advisor_thumb .social-info {
            position: absolute;
            z-index: 1;
            width: 100%;
            bottom: 0;
            right: 30px;
            text-align: right;
        }

        .single_advisor_profile .advisor_thumb .social-info a {
            font-size: 14px;
            color: #020710;
            padding: 0 5px;
        }

        .single_advisor_profile .advisor_thumb .social-info a:hover,
        .single_advisor_profile .advisor_thumb .social-info a:focus {
            color: #3f43fd;
        }

        .single_advisor_profile .advisor_thumb .social-info a:last-child {
            padding-right: 0;
        }

        .single_advisor_profile .single_advisor_details_info {
            position: relative;
            z-index: 1;
            padding: 30px;
            text-align: right;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            border-radius: 0 0 15px 15px;
            background-color: #ffffff;
        }

        .single_advisor_profile .single_advisor_details_info::after {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            position: absolute;
            z-index: 1;
            width: 50px;
            height: 3px;
            background-color: #3f43fd;
            content: "";
            top: 12px;
            right: 30px;
        }

        .single_advisor_profile .single_advisor_details_info h6 {
            margin-bottom: 0.25rem;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .single_advisor_profile .single_advisor_details_info h6 {
                font-size: 14px;
            }
        }

        .single_advisor_profile .single_advisor_details_info p {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            margin-bottom: 0;
            font-size: 14px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .single_advisor_profile .single_advisor_details_info p {
                font-size: 12px;
            }
        }

        .single_advisor_profile:hover .advisor_thumb::after,
        .single_advisor_profile:focus .advisor_thumb::after {
            background-color: #070a57;
        }

        .single_advisor_profile:hover .advisor_thumb .social-info a,
        .single_advisor_profile:focus .advisor_thumb .social-info a {
            color: #ffffff;
        }

        .single_advisor_profile:hover .advisor_thumb .social-info a:hover,
        .single_advisor_profile:hover .advisor_thumb .social-info a:focus,
        .single_advisor_profile:focus .advisor_thumb .social-info a:hover,
        .single_advisor_profile:focus .advisor_thumb .social-info a:focus {
            color: #ffffff;
        }

        .single_advisor_profile:hover .single_advisor_details_info,
        .single_advisor_profile:focus .single_advisor_details_info {
            background-color: #070a57;
        }

        .single_advisor_profile:hover .single_advisor_details_info::after,
        .single_advisor_profile:focus .single_advisor_details_info::after {
            background-color: #ffffff;
        }

        .single_advisor_profile:hover .single_advisor_details_info h6,
        .single_advisor_profile:focus .single_advisor_details_info h6 {
            color: #ffffff;
        }

        .single_advisor_profile:hover .single_advisor_details_info p,
        .single_advisor_profile:focus .single_advisor_details_info p {
            color: #ffffff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function modalUpdateImage(id) {
            $('#modalUpdateImage').modal('show');
            $('#formUpdateImage').attr('action', `/profil/${id}/updateImage`);
        }

        $(document).ready(function() {
            $('#formUpdateImage').validate({
                rules: {
                    gambar: {
                        required: true,
                        // extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    gambar: {
                        required: "Foto wajib diisi",
                        extension: "Hanya file gambar (jpg, jpeg, png, gif) yang diperbolehkan"
                    }
                },
                submitHandler: function(form) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#modalUpdateImage').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const res = xhr.responseJSON;
                                $.each(res.errors, function(key, value) {
                                    $('[name="' + key + '"]').addClass(
                                        'is-invalid');
                                    $('#error-' + key).html(value[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    text: res.message ||
                                        'Harap isi data dengan benar.'
                                });
                            } else if (xhr.status === 302) {
                                window.location.href = xhr.getResponseHeader('Location');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan Server',
                                    text: 'Terjadi kesalahan tak terduga. Silakan coba lagi.'
                                });
                            }
                        },
                    });
                    return false;
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

        function preview() {
            $('#preview-image').css('display', 'block');
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            $('#preview-image').css('display', 'none');
            document.getElementById('gambar').value = null;
            frame.src = "";
        }
    </script>
@endpush
