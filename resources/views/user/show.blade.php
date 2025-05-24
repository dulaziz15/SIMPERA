{{-- @if(empty($profil->pengguna)) 
    
@include('user.profilNotFound')

@else --}}
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalShowPeranLabel">Detail User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3 p-4">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered">
                        {{-- {{var_dump($user->profil)}} --}}
                        <tr>
                            <th>ID User</th>
                            <td>{{ $user->id_pengguna }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{$user->nama_pengguna}}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{$user->profil->nama_lengkap}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->surel}}</td>
                        </tr>
                        <tr>
                            <th>Peran</th>
                            <td>{{$user->peran->nama}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
{{-- @endif --}}