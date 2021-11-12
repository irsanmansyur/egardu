<?php if ($this->session->set_flashdata('message')) { ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-ban"></i> Error</h4>
			<p><?php echo $this->session->set_flashdata('message'); ?></p>
		</div>
	</div>
<?php } else {
} ?>

	<!-- horizontal Basic Forms Start -->
	<div class="pd-20 card-box mb-30">
		<div class="clearfix">
			<div class="pull-left">
				<h4 class="text-blue h4">Tambah Data User</h4>
			</div>
		</div>
		<?php
		echo form_open_multipart('User/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator"));
		?>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="username" class="control-label">Nip</label>
					<div class="input-group">
						<input type="text" class="form-control" name="nip" id="username" data-error="Nip harus diisi" placeholder="34534231859593" value="" required />

					</div>
					<div class="help-block with-errors"></div>
				</div>

			</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="username" class="control-label">Nama lengkap</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_lengkap" id="username" data-error="Nama lengkap harus diisi" placeholder="Nama Username" value="" required />

						</div>
						<div class="help-block with-errors"></div>
					</div>

				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="username" class="control-label">Nama Username</label>
						<div class="input-group">
							<input type="text" class="form-control" name="username" id="username" data-error="Nama Username harus diisi" placeholder="Nama Username" value="" required />

						</div>
						<div class="help-block with-errors"></div>
					</div>
				</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="username" class="control-label">Nama Atasan</label>
					<div class="input-group">
						<select name="supervisor_name"  id="supervisor_name" class="form-control" style="width: 100%;" data-error="Nama Atasan harus dipilih" value="" >
							<option selected disabled>--Pilih nama Atasan--</option>
							<?php foreach ($lists as $l) {
								echo "<option value='" . $l->username . " - " . $l->nama_kategori . ' - approver'."'  >".$l->username . "  " . $l->nama_kategori. ' - approver'. '  ' . $l->nama_site."</option>";
							} ?>
						</select>

					</div>
					<div class="help-block with-errors"></div>
				</div>
			</div>


				</div>
				<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label for="password" class="control-label">Password</label>
								<div class="input-group">
									<input type="password" class="form-control" name="password" id="password" data-error="Password harus diisi" placeholder="Password" value="" required />

								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="akses" class="control-label">Role</label>
								<div class="input-group">
									<select class="form-control js-example-basic-multiple" multiple id="mySelect2" name="akses[]">
										<?php
										foreach ($akses as $a) {
											echo "<option value=' $a->id_akses'>$a->nama_akses</option>";
										}
										?>
									</select>

								</div>
							</div>

						</div>
						<div class="col-md-4">


								<div class="form-group">
									<label for="foto" class="control-label">Foto</label>
									<div class="input-group">
										<input type="file" name="foto" class="form-control">

									</div>
									<div class="help-block with-errors"></div>
								</div>
						</div>


				</div>










			<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
			<a href="<?php echo base_url() ?>User" class="btn btn-default ">Cancel</a>
		</form>
	</div>
	<!-- horizontal B	asic Forms End -->
