<form action="{{ url('/pelaporan/store') }}" method="POST" id="form-tambah" class="needs-validation"
    enctype="multipart/form-data" novalidate>
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3 p-4">
                <div class="card">
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Perhatian!!!</h5>
                            <ul>
                                <li>Pilih gedung terlebih dahulu untuk memilih ruangan</li>
                                <li>Pilih ruangan untuk melihat daftar fasilitas</li>
                                <li>Pastikan data yang diisi sudah benar</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="progrss-wizard" class="twitter-bs-wizard">
                            <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a href="#dokumen_pendukung" class="nav-link" data-toggle="tab">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Dokumen Pendukung">
                                            <i class="bx bx-image-add"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#detail_kerusakan" class="nav-link" data-toggle="tab">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Detail Kerusakan">
                                            <i class="bx bx-detail"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress mt-4">
                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"></div>
                            </div>
                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <div class="tab-pane" id="dokumen_pendukung">
                                    <div>
                                        <div class="text-center mb-4">
                                            <h5>Dokumen Pendukung</h5>
                                            <p class="card-title-desc">Upload Gambar sebagai bukti</p>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="url_foto">Foto Fasilitas <span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" name="url_foto" id="url_foto"
                                                        onchange="preview()" accept="image/*" class="form-control"
                                                        required>
                                                    <div id="error-url_foto" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="card mt-3">
                                                    <div class="card-body">
                                                        <img id="frame" src="" alt="Preview gambar"
                                                            class="img-fluid my-3" style="max-width: 100%" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="javascript:void(0);"
                                                    class="btn btn-primary previous-btn"><i
                                                        class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                            <li class="next"><a href="javascript:void(0);"
                                                    class="btn btn-primary next-btn">Next <i
                                                        class="bx bx-chevron-right ms-1"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-pane" id="detail_kerusakan">
                                    <div>
                                        <div class="text-center mb-4">
                                            <h5>Detail Kerusakan</h5>
                                            <p class="card-title-desc">Detail Kerusakan Fasilitas</p>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h5 class="font-size-16 mb-3"><i
                                                        class="fas fa-exclamation-triangle me-2"></i>Tingkat Kerusakan
                                                </h5>
                                                <div class="row" id="radio" role="radiogroup"
                                                    aria-label="Tingkat Kerusakan">
                                                    <!-- Ringan -->
                                                    <div class="col-md-4">
                                                        <div class="form-check card-radio">
                                                            <input class="form-check-input" type="radio"
                                                                name="tingkat_kerusakan" id="ringan"
                                                                value="1" checked aria-checked="true"
                                                                role="radio" tabindex="0" />
                                                            <label class="form-check-label" for="ringan"
                                                                tabindex="0" aria-describedby="desc-ringan"
                                                                role="button">
                                                                <div class="card-radio-content p-3 rounded-3 border">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="avatar-xs">
                                                                                <div
                                                                                    class="avatar-title bg-success-subtle text-success rounded-circle">
                                                                                    <i class="fas fa-check-circle"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="font-size-14 mb-1">Ringan</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Sedang -->
                                                    <div class="col-md-4">
                                                        <div class="form-check card-radio">
                                                            <input class="form-check-input" type="radio"
                                                                name="tingkat_kerusakan" id="sedang"
                                                                value="2" aria-checked="false" role="radio"
                                                                tabindex="-1" />
                                                            <label class="form-check-label" for="sedang"
                                                                tabindex="0" aria-describedby="desc-sedang"
                                                                role="button">
                                                                <div class="card-radio-content p-3 rounded-3 border">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="avatar-xs">
                                                                                <div
                                                                                    class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                                                                    <i
                                                                                        class="fas fa-exclamation-circle"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="font-size-14 mb-1">Sedang</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Berat -->
                                                    <div class="col-md-4">
                                                        <div class="form-check card-radio">
                                                            <input class="form-check-input" type="radio"
                                                                name="tingkat_kerusakan" id="berat"
                                                                value="3" aria-checked="false" role="radio"
                                                                tabindex="-1" />
                                                            <label class="form-check-label" for="berat"
                                                                tabindex="0" aria-describedby="desc-berat"
                                                                role="button">
                                                                <div class="card-radio-content p-3 rounded-3 border">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="avatar-xs">
                                                                                <div
                                                                                    class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                                    <i class="fas fa-times-circle"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5 class="font-size-14 mb-1">Berat</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="error-tingkat_kerusakan" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="deskripsi">Deskripsi <span
                                                            class="text-danger">*</span></label>
                                                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required></textarea>
                                                    <div id="error-deskripsi" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="javascript:void(0);"
                                                    class="btn btn-primary previous-btn"><i
                                                        class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                            <button type="submit" class="btn btn-primary float-end">
                                                <i class="fas fa-save me-2"></i>Simpan
                                            </button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
            </div>
        </div>
    </div>
    <input type="hidden" name="id_fasilitas" id="id_fasilitas" value="{{ $fasilitas->id_fasilitas }}">
</form>

<style>
    .card-radio .form-check-input {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
        margin: 0;
        pointer-events: none;
    }

    .card-radio .form-check-label {
        cursor: pointer;
        display: block;
        outline: none;
    }

    .card-radio-content {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid #ddd;
        border-radius: 12px;
        background-color: white;
        box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
        padding: 1rem;
        user-select: none;
    }

    .card-radio .form-check-label:hover .card-radio-content,
    .card-radio .form-check-label:focus-visible .card-radio-content {
        border-color: #405189;
        box-shadow: 0 0 8px rgba(64, 81, 137, 0.6);
    }

    .card-radio .form-check-input:checked+label .card-radio-content {
        border-color: #405189;
        background-color: #f7f7ff;
        transform: scale(1.03);
    }

    .card-radio-content {
        will-change: transform, box-shadow;
    }

    .card-radio .form-check-label:focus-visible {
        outline: 3px solid #405189;
        outline-offset: 3px;
        border-radius: 12px;
    }
</style>

<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage() {
        document.getElementById('url_foto').value = null;
        frame.src = "";
    }

    $("#progrss-wizard").bootstrapWizard({
        onTabShow: function(a, i, s) {
            i = (s + 1) / i.find("li").length * 100;
            $("#progrss-wizard").find(".progress-bar").css({
                width: i + "%"
            })
        }
    });

    $(document).ready(function() {
        $('.next-btn').click(function() {
            const currentTab = $(this).closest('.tab-pane');
            const isValid = validateCurrentTab(currentTab);
            if (isValid) {
                const nextTab = currentTab.next('.tab-pane');
                if (nextTab.length) {
                    currentTab.removeClass('active show');
                    nextTab.addClass('active show');
                    updateProgressBar();
                }
            }
        });

        $('.previous-btn').click(function() {
            const currentTab = $(this).closest('.tab-pane');
            const prevTab = currentTab.prev('.tab-pane');
            if (prevTab.length) {
                currentTab.removeClass('active show');
                prevTab.addClass('active show');
                updateProgressBar();
            }
        });

        function validateCurrentTab(tab) {
            let isValid = true;
            tab.find(':input[required]').each(function() {
                if (!this.checkValidity()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    $(this).siblings('.error-text').text(this.validationMessage);
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.error-text').text('');
                }
            });
            const radioGroup = tab.find('input[name="tingkat_kerusakan"]');
            if (radioGroup.length) {
                const isChecked = radioGroup.is(':checked');
                if (!isChecked) {
                    isValid = false;
                    $('#error-tingkat_kerusakan').text('Tingkat Kerusakan wajib dipilih');
                } else {
                    $('#error-tingkat_kerusakan').text('');
                }
            }
            return isValid
        }

        function updateProgressBar() {
            const totalTabs = $('.tab-pane').length;
            const activeTab = $('.tab-pane.active').index() + 1;
            const progressPercentage = (activeTab / totalTabs) * 100;
            $('#bar .progress-bar').css('width', progressPercentage + '%');
        }

        $('#form-tambah').validate({
            rules: {
                deskripsi: {
                    required: true,
                },
                tingkt_kerusakan: {
                    required: true,
                },
                url_foto: {
                    required: true,
                }
            },
            messages: {
                deskripsi: {
                    required: "Deskripsi wajib diisi",
                },
                tingkt_kerusakan: {
                    required: "Tingkat Kerusakan wajib diisi",
                },
                url_foto: {
                    required: "Foto wajib diupload",
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
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Ditambahkan',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            window.location.reload();
                        } else {
                            $('.invalid-feedback').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const res = xhr.responseJSON;
                            $('.invalid-feedback').text('');
                            $('.form-control').removeClass('is-invalid');

                            $.each(res.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: res.message ||
                                    'Harap isi data dengan benar.'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Terjadi kesalahan tak terduga. Silakan coba lagi.'
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                element.closest('#radio').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    });
</script>
