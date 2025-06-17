@extends('layout.app')

@section('content')
    <div class="row">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                    <div class="btn-group">
                        <button onclick="modalAction('{{ url('user/create') }}')" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                        <button onclick="gridLayout()" class="btn btn-sm btn-primary">
                            <i class="fas fa-th-large"></i> Grid
                        </button>
                        <button onclick="listLayout()" class="btn btn-sm btn-info">
                            <i class="fas fa-list"></i> List
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body" id="user-list">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="col-lg-4">
                            <label class="control-label col-form-label">Filter :</label>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="id_peran_filter" data-trigger name="id_peran">
                                <option value="">- Semua -</option>
                                @foreach ($peran as $item)
                                    <option value="{{ $item->id_peran }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">peran Pengguna</small>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive"
                    id="table_user">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="user-grid" style="display: none;">
                @include('user.grid')
            </div>
            <div id="myModal" class="modal fade" tabindex="-1">
            </div>
            <div id="modalProfil" class="modal fade" tabindex="-1">
            </div>
        </div>
    @endsection

    @push('css')
    @endpush
    @push('scripts')
        @include('user.ajaxHandler')
        <script>
            function gridLayout() {
                $('#user-list').css('display', 'none');
                $('#user-grid').css('display', 'block');
            }

            function listLayout() {
                $('#user-grid').css('display', 'none');
                $('#user-list').css('display', 'block');
            }
        </script>
    @endpush
