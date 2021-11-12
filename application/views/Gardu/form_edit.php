<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
.select2-selection__choice__display{
	color:black;
}
</style>
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-ban"></i> Error</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } else { } ?>

<div class="pd-20 card-box mb-30">

	<div class="row">
		<div class='col-xs-12'>
			<div class='box box-primary'>
				<div class='box-header  with-border'>
					<h3 class='box-title'>Edit Data Gardu</h3>
				</div>
				<br>
				<div class="box-body">
					<?php echo form_open_multipart('Gardu/edit', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
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

					<div class="col-md-8">
					<div class="form-group">
						<label for="harga" class="control-label">Pekerjaan</label>
						<div class="input-group">

							<textarea name="pekerjaan" id="pekerjaan"  data-error="Pekerjaan harus di isi"  cols="60" rows="3"><?php echo $record['pekerjaan'] ?></textarea>

						</div>
						<div class="help-block with-errors"></div>
					</div>
				</div>

					</div>





					<div class="box-footer">
						<input type="hidden" name="id" value="<?php echo $record['id_operational']; ?>">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>Gardu" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>

</div>

<script>

$('#mySelect2').select2({
  selectOnClose: true
});</script>
