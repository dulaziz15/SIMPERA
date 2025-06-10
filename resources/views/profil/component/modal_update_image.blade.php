<div class="modal fade" id="modalUpdateImage" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Update Foto Profil</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<form id="formUpdateImage" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<div class="form-group">
									<label class="form-label">Foto Profil</label>
									<input type="file" name="gambar" id="gambar" value="" class="form-control" accept="image/*"
										onchange="preview()">
									<div id="error-gambar" class="error-text"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="display: none;" id="preview-image">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body p-2">
									<img id="frame" src="" alt="Preview gambar" class="img-fluid my-3" style="max-width: 100%" />
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-secondary" onclick="clearImage()">Hapus Gambar</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>
