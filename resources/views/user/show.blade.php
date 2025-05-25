<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalShowPeranLabel">Detail User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3 p-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <img src="{{ asset('storage/app/public/' . $user->profil->foto_profil ) }}" alt="Foto Profil"
                                            class="img-fluid rounded-circle d-block">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1">{{ $user->profil->nama_lengkap }}</h5>
                                        <p class="text-muted font-size-13">{{ $user->surel }}</p>

                                        <div
                                            class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                            <div><span class="badge bg-success">{{ $user->peran->nama }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto order-1 order-sm-2">
                            <div class="d-flex align-items-start justify-content-end gap-2">
                                <div>
                                    <div class="dropdown">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Action</button>
                                            <button type="button"
                                                class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" onclick="modalAction('{{ url('user/' . $user->id_pengguna . '/edit_profil')}}')" data-bs-dismiss="modal"><i class="bx bx-edit"></i> Edit</button>
                                                <button class="dropdown-item" onclick="modalAction('{{ url('user/' . $user->id_pengguna . '/confirm')}}')" data-bs-dismiss="modal"><i class="bx bx-trash"></i> Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="data mt-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td>{{ $user->nama_pengguna }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td>{{ $user->profil->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $user->surel }}</td>
                            </tr>
                            <tr>
                                <th>Role User</th>
                                <td>:</td>
                                <td>{{ $user->peran->nama }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>