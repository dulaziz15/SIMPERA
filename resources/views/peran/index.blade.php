@extends('layout.app')

@section('content')
    <div class="row">
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="card-tools">
                    <button onclick="modalAction('{{ url('peran/create') }}')"
                        class="btn btn-sm btn-success mt-1">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive"
                    id="table_peran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peran</th>
                            <th>Kode Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="myModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('css')
    @endpush
    @push('scripts')
        @include('peran.ajaxHandler')
    @endpush
