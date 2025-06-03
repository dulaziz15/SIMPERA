<form action="{{ url('/pelaporan/' . $laporan->id_laporan . '/update') }}" method="POST" id="form-tambah"
    class="needs-validation" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Laporan</h5>
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
                                @if (Auth::user()->isAdmin())
                                    <li class="nav-item">
                                        <a href="#detail_fasilitas" class="nav-link" data-toggle="tab">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Detail fasilitas">
                                                <i class="bx bx-buildings"></i>
                                            </div>
                                        </a>
                                    </li>
                                @endif
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

                                @if (Auth::user()->isAdmin())
                                    <div class="tab-pane active" id="detail_fasilitas">
                                        <div class="text-center mb-4">
                                            <h5>Detail Fasilitas</h5>
                                            <p class="card-title-desc">Pilih Fasilitas berdasarkan lokasi</p>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="id_gedung">Gedung <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" id="id_gedung" name="id_gedung"
                                                        required>
                                                        <option value="">- Pilih Gedung -</option>
                                                        @foreach ($gedung as $item)
                                                            <option value="{{ $item->id_gedung }}"
                                                                {{ $item->id_gedung == $laporan->fasilitas->ruangan->gedung->id_gedung ? 'selected' : '' }}>
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="error-id_gedung" class="error-text"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="id_ruangan">Ruangan <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" id="id_ruangan" name="id_ruangan"
                                                        required>
                                                        <option value="">- Pilih Ruangan -</option>
                                                        @foreach ($ruangan as $item)
                                                            <option value="{{ $item->id_ruangan }}"
                                                                {{ $item->id_ruangan == $laporan->fasilitas->id_ruangan ? 'selected' : '' }}>
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="error-id_ruangan" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="id_fasilitas">Fasilitas <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control" id="id_fasilitas" name="id_fasilitas"
                                                        required>
                                                        <option value="">- Pilih Fasilitas -</option>
                                                        @foreach ($fasilitas as $item)
                                                            <option value="{{ $item->id_fasilitas }}"
                                                                {{ $item->id_fasilitas == $laporan->id_fasilitas ? 'selected' : '' }}>
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="error-id_fasilitas" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="next"><a href="javascript:void(0);"
                                                    class="btn btn-primary next-btn">Next <i
                                                        class="bx bx-chevron-right ms-1"></i></a></li>
                                        </ul>
                                    </div>
                                @endif

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
                                                        onchange="preview()" accept="image/*" class="form-control">
                                                    <div id="error-url_foto" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="card mt-3">
                                                    <div class="card-body">
                                                        <img id="frame"
                                                            src="{{ asset('storage/' . $laporan->url_foto) }}"
                                                            alt="Preview gambar" class="img-fluid my-3"
                                                            style="max-width: 100%" />
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
                                                                value="1"
                                                                {{ $laporan->firstPendukung->tingkat_kerusakan === 1 ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="ringan">
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
                                                                value="2"
                                                                {{ $laporan->firstPendukung->tingkat_kerusakan === 2 ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="sedang">
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
                                                                value="3"
                                                                {{ $laporan->firstPendukung->tingkat_kerusakan === 3 ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="berat">
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
                                                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required>{{ $laporan->deskripsi }}</textarea>
                                                    <div id="error-deskripsi" class="error-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="javascript:void(0);"
                                                    class="btn btn-primary previous-btn"><i
                                                        class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                            <button type="submit" class="float-end btn btn-primary">Simpan</button>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
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

    .is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .error-text {
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
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
        const currentRuangan = "{{ $laporan->fasilitas->id_ruangan }}";
        const currentFasilitas = "{{ $laporan->id_fasilitas }}";

        if (currentRuangan) {
            loadFacilities(currentRuangan);
        }

        $('#id_gedung').change(function() {
            const idGedung = $(this).val();
            if (idGedung) {
                $.get('/pelaporan/ruangan-by-gedung/' + idGedung, function(data) {
                    $('#id_ruangan').empty().append(
                        '<option value="">- Pilih Ruangan -</option>');
                    $.each(data, function(key, value) {
                        const selected = value.id_ruangan == currentRuangan ?
                            'selected' : '';
                        $('#id_ruangan').append(
                            `<option value="${value.id_ruangan}" ${selected}>${value.nama}</option>`
                            );
                    });

                    if ($('#id_ruangan option[value="' + currentRuangan + '"]').length > 0) {
                        $('#id_ruangan').val(currentRuangan).trigger('change');
                    }
                }).fail(function() {
                    showError('Gagal memuat data ruangan');
                });
            } else {
                resetDependentFields();
            }
        });

        $('#id_ruangan').change(function() {
            const idRuangan = $(this).val();
            if (idRuangan) {
                loadFacilities(idRuangan);
            } else {
                $('#id_fasilitas').empty().append('<option value="">- Pilih Fasilitas -</option>');
            }
        });

        function loadFacilities(idRuangan) {
            $.get('/pelaporan/all-fasilitas-by-ruangan/' + idRuangan, function(data) {
                $('#id_fasilitas').empty().append('<option value="">- Pilih Fasilitas -</option>');
                $.each(data, function(key, value) {
                    const selected = value.id_fasilitas == currentFasilitas ? 'selected' : '';
                    $('#id_fasilitas').append(
                        `<option value="${value.id_fasilitas}" ${selected}>${value.nama}</option>`
                        );
                });
            }).fail(function() {
                showError('Gagal memuat data fasilitas');
            });
        }

        function resetDependentFields() {
            $('#id_ruangan').empty().append('<option value="">- Pilih Ruangan -</option>');
            $('#id_fasilitas').empty().append('<option value="">- Pilih Fasilitas -</option>');
        }

        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message
            });
        }

        $('.next-btn').click(function() {
            const currentTab = $(this).closest('.tab-pane');
            if (validateCurrentTab(currentTab)) {
                navigateToTab(currentTab.next('.tab-pane'));
            }
        });

        $('.previous-btn').click(function() {
            const currentTab = $(this).closest('.tab-pane');
            navigateToTab(currentTab.prev('.tab-pane'));
        });

        function validateCurrentTab(tab) {
            let isValid = true;

            tab.find(':input[required]').each(function() {
                if (!this.checkValidity()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    $(this).siblings('.error-text').text(this.validationMessage ||
                        'Field ini wajib diisi');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.error-text').text('');
                }
            });

            const radioGroup = tab.find('input[name="tingkat_kerusakan"]');
            if (radioGroup.length && !radioGroup.is(':checked')) {
                isValid = false;
                $('#error-tingkat_kerusakan').text('Tingkat Kerusakan wajib dipilih');
            } else {
                $('#error-tingkat_kerusakan').text('');
            }

            return isValid;
        }

        function navigateToTab(nextTab) {
            if (nextTab.length) {
                $('.tab-pane').removeClass('active show');
                nextTab.addClass('active show');
                updateProgressBar();
            }
        }

        function updateProgressBar() {
            const totalTabs = $('.tab-pane').length;
            const activeTab = $('.tab-pane.active').index() + 1;
            const progressPercentage = (activeTab / totalTabs) * 100;
            $('#bar .progress-bar').css('width', progressPercentage + '%');
        }

        $('#form-tambah').validate({
            rules: {
                id_gedung: {
                    required: true
                },
                id_ruangan: {
                    required: true
                },
                id_fasilitas: {
                    required: true
                },
                deskripsi: {
                    required: true
                },
                tingkat_kerusakan: {
                    required: true
                },
                url_foto: {
                    required: {{ empty($laporan->url_foto) ? 'true' : 'false' }},
                    extension: "jpg|jpeg|png|gif"
                }
            },
            messages: {
                id_gedung: {
                    required: "Gedung wajib dipilih"
                },
                id_ruangan: {
                    required: "Ruangan wajib dipilih"
                },
                id_fasilitas: {
                    required: "Fasilitas wajib dipilih"
                },
                deskripsi: {
                    required: "Deskripsi wajib diisi"
                },
                tingkat_kerusakan: {
                    required: "Tingkat Kerusakan wajib dipilih"
                },
                url_foto: {
                    required: "Foto wajib diupload",
                    extension: "Hanya file gambar (jpg, jpeg, png, gif) yang diperbolehkan"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.attr("name") === "tingkat_kerusakan") {
                    error.appendTo('#error-tingkat_kerusakan');
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
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
                    beforeSend: function() {
                        $('.btn-primary').prop('disabled', true).html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...'
                            );
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function() {
                                if (typeof dataPelaporan !== 'undefined' &&
                                    typeof dataPelaporan.ajax !== 'undefined') {
                                    dataPelaporan.ajax.reload();
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            showFormErrors(response.msgField);
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
                            showFormErrors(res.msgField);
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
                    },
                    complete: function() {
                        $('.btn-primary').prop('disabled', false).html('Simpan');
                    }
                });
            }
        });

        function showFormErrors(errors) {
            $('.error-text').text('');
            $('.is-invalid').removeClass('is-invalid');

            if (errors) {
                $.each(errors, function(prefix, val) {
                    const errorElement = $('#error-' + prefix);
                    if (errorElement.length) {
                        errorElement.text(val[0]);
                    }
                    $('#' + prefix).addClass('is-invalid');
                });
            }
        }
    });
</script>
