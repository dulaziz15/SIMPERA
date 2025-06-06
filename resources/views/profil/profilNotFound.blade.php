<form action="{{ url('/user/' . Auth::user()->id_pengguna . '/store-profil') }}" enctype="multipart/form-data"
	method="POST" id="form-tambah" class="needs-validation">
	@csrf

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Tambah Data Profil</h5>
		</div>
		<div class="card-body row g-3 p-4">
			<div class="card mb-3">
				<div class="mt-2">
					<div class="alert alert-warning">
						<h5><i class="fas fa-exclamation-triangle"></i> Perhatian!!!</h5>
						<ul>
							<li>User ini masih belum memiliki profil. Dimohon untuk mengisikan profil</li>
						</ul>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Nama Lengkap</label>
								<input type="text" name="nama_lengkap" id="nama_lengkap" value="" class="form-control">
								<div id="error-nama_lengkap" class="error-text"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Foto Profil</label>
								<input type="file" name="foto_profil" id="foto_profil" value="" onchange="preview()" accept="image/*"
									class="form-control">
								<div id="error-foto_profil" class="error-text"></div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="card mt-3">
									<div class="card-body">
										<img id="frame" src="" class="img-fluid my-3" max-width="100%" alt="Preview gambar" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer text-end">
			<button class="btn btn-secondary" type="button" onclick="clearImageProfile()">Clear Image</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

@push('scripts')
	<script>
		// Preview Gambar
		function preview() {
			frame.src = URL.createObjectURL(event.target.files[0]);
		}

		// Clear Gambar
		function clearImageProfile() {
			document.getElementById('foto_profil').value = null;
			frame.src = "";
		}

		$(document).ready(function() {
			$('#form-tambah').validate({
				rules: {
					nama_lengkap: {
						required: true,
						minlength: 3,
						maxlength: 50
					},
				},
				messages: {
					nama_lengkap: {
						required: "Nama wajib diisi.",
						minlength: "Minimal 3 karakter.",
						maxlength: "Maksimal 50 karakter."
					},
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
									text: response.message
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
@endpush
