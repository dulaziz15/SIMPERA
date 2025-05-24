{{-- @if(empty($profil->pengguna)) 
    
@include('user.profilNotFound')

<<<<<<< HEAD
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data Profile</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->nama_pengguna }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>