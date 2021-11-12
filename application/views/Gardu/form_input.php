<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
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
							<div class="container">
								<label for="nama_barang" name="nama_gardu" class="control-label">Nama Gardu</label>

			<select class="theSelect" name="nama_gardu">
				<option value="Gardu_01-Alamat_1">Gardu_01-Alamat_1</option>
				<option value="Gardu_02-Alamat_2">Gardu_02-Alamat_2</option>
				<option value="Gardu_03-Alamat_3">Gardu_03-Alamat_3</option>
				<option value="Gardu_04-Alamat_4">Gardu_04-Alamat_4</option>
				<option value="Gardu_05-Alamat_5">Gardu_05-Alamat_5</option>
				<option value="Gardu_06-Alamat_6">Gardu_06-Alamat_6</option>
				<option value="Gardu_07-Alamat_7">Gardu_07-Alamat_7</option>
				<option value="Gardu_08-Alamat_8">Gardu_08-Alamat_8</option>
				<option value="Gardu_09-Alamat_9">Gardu_09-Alamat_9</option>
				<option value="Gardu_10-Alamat_10">Gardu_10-Alamat_10</option>
				<option value="Gardu_11-Alamat_11">Gardu_11-Alamat_11</option>
			</select>
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
	<script>
		$(".theSelect").select2();
	</script>
