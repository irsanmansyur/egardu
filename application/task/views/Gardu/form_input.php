<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-ban"></i> Error</h4>
			<p><?php echo $this->session->flashdata('message'); ?></p>
		</div>
	</div>
<?php } else {
} ?>
<div class="pd-20 card-box mb-30">


				<div class='box-header  with-border'>
					<h3 class='box-title'>New Operational Gardu</h3>
				</div>
				<br>

					<?php echo form_open_multipart('Gardu/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="nama_barang" class="control-label">Tanggal Masuk</label>
								<div class="input-group">
									<input type="text" class="form-control" name="date_request" id="date_request" readonly value="<?php echo date('Y-m-d '); ?>" required />
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="nama_barang" class="control-label">Nama User</label>
								<div class="input-group">
									<input type="text" name="username" readonly class="form-control" value="<?php echo $this->session->userdata('username'); ?>">
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="nama_barang" class="control-label">Nip</label>
								<div class="input-group">
									<input type="text" class="form-control" name="nip_karyawan" readonly id="nip" value="<?php echo $user['nip'] ?>" data-error="nip harus diisi" required />
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="nama_barang" class="control-label">Nama Gardu</label>
								<div class="input-group">
									<input type="text" class="form-control" name="nama_gardu" id="jenis" data-error="Nama Gardu harus diisi" placeholder="Gardu Chemco" required />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="harga">Pekerjaan</label>
								<div class="input-group">
									<textarea class="form-control" name="pekerjaan" id="exampleFormControlTextarea1" placeholder="Scada AMR" rows="3" cols="80"></textarea>

								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>


				<div class="box-footer">
					<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
					<a href="<?php echo base_url() ?>Gardu" class="btn btn-default ">Cancel</a>
				</div>
				</form>


	</div>
