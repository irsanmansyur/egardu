<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<style type="text/css">
	table,
	th,
	tr,
	td {
		text-align: center;
	}

	.swal2-popup {
		font-family: inherit;
		font-size: 1.2rem;
	}

	.btn-group,
	.btn-group-vertical {
		position: relative;
		display: initial;
		vertical-align: middle;
	}

	.btn btn-success {
		background-color: white;
		border: none;
		color: white;
		padding: 12px 30px;
		cursor: pointer;
		font-size: 20px;
	}

	/* Darker background on mouse-over */
	.btn:hover {
		background-color: RoyalBlue;
	}
</style>

<?php if ($this->session->flashdata('message')) : ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-check"></i>Berhasil</h4>
			<p><?php echo $this->session->flashdata('message'); ?></p>
		</div>
	</div>
<?php endif ?>


<!-- Modal -->


<div class="pd-20">
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<a>Approval Operational Gardu</a>
		</div>
	</div>
</div>


<div class="pb-20">

	<div class="table-responsive">

	</div>
	<table class="table table-striped">
		<thead>
			<tr style="border-spacing: 10px;  border-collapse: separate;">
				<th class="table-plus datatable-nosort" style=" margin: 1px; padding-left: 1px; padding-top:10px; font-size: 10px; width: 1%; height:1px;">No</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1px; width: 1%;">Tanggal Masuk</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nama Gardu</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nama Petugas</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nip</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Pekerjaan</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Check In</th>
				<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Check Out</th>
				<th class="datatable-nosort" style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Action</th>
			</tr>
		<tbody>
			<?php
			$no = 0;
			foreach ($data as $r) :
				$tanggal1 = new DateTime($r->date_request);
				$tanggal2 = new DateTime();


				$perbedaan = $tanggal2->diff($tanggal1);
				$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

			?>
				<tr style="background: white;">
					<td style="font-size: 10px;"><?php echo ++$no; ?></td>
					<td style="padding-left: 1px; margin-bottom: 5%; padding-bottom:1px; font-size: 10px; width: 1%; height:5px;"><?php echo $r->date_request; ?></td>

					<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
					<td style="font-size: 10px;"><?php echo $r->username; ?></td>
					<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
					<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
					<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
					<td style="font-size: 10px;"> <span>
							<img style="width:60px;height:60px" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
						</span><?php echo ($r->time_out != null) ? date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i') : ''; ?></td>
					<td>
						<?php
						$jamKeberangkatan = date('H:i:s', strtotime($r->time_in));

						if ($perbedaan->d > 0) : ?>
							00:00:00 00:00
						<?php elseif ($r->approval_sp_status == "approved") : ?>
							<?= $r->approval_sp_at; ?>
						<?php else : ?>
							<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-check"></span></a>
						<?php endif; ?>
					</td>

				</tr>
			<?php
			endforeach;
			?>
		</tbody>
	</table>













	<?php
	foreach ($wait as $r) : ?>



	<?php endforeach;
	$no = 0;
	//var_dump($record); die();

	foreach ($AllData as $r) {
		$nama_driver = '';



	?>

		<div class="modal fade" id="showModalPdf<?= $r->id_operational; ?>" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="width: 100%;">
						<table class="table table-striped">
							<thead>

								<tr style="border-spacing: 10px;  border-collapse: separate;">
									<th class="table-plus datatable-nosort" style=" margin: 1px; padding-left: 1px; padding-top:10px; font-size: 10px; width: 1%; height:1px;">No</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1px; width: 1%;">Tanggal Masuk</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nama Gardu</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nama Petugas</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Nip</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Pekerjaan</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Check In</th>
									<th style=" margin: 1px; padding-left: 1px; font-size: 10px; width: 1%; height:1%;">Check Out</th>
								</tr>

							</thead>
							<tbody>
								<tr>
									<td class="table-plus" style="padding-left: 1px; font-size: 10px; width: 1%; height:10%;"><?php echo ++$no; ?></td>
									<td style="padding-left: 1px; margin-bottom: 5%; padding-bottom:1px; font-size: 10px; width: 1%; height:5px;"><?php echo $r->date_request; ?></td>
									<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->nama_gardu; ?></td>
									<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->username; ?></td>
									<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->nip; ?></td>
									<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->pekerjaan; ?>
									<td style="font-size: 10px; width: 1%">
									<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->time_in; ?>
									</td>
									<?php echo $r->image; ?> <?php echo $r->time_out ?></td>
								</tr>
							</tbody>
						</table>

					</div>
					<div class="modal-footer">
						<?php
						if ($r->approval_sp_status == 'waiting') {
							$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();
						?>
							<a href="<?= base_url('index.php/Approval/update/' . $r->id_operational . '/approve') ?>" class="btn btn-success btn-sm btn-approval" data-approval="approve" data-username="<?= $user->username ?>-" style="float:right;margin-right: 13px;"><span class="fa fa-check"></span> Acknowledge </a>
						<?php } else { ?>
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						<?php } ?>
						<br>
						<span>
							<img style="width:600px;height:600px" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
						</span>
					</div>
				</div>
			</div>
		</div>
</div>
<?php } ?>

<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script type="text/javascript">
	$("body").on("click", ".btn-approval", function(e) {
		e.preventDefault();
		var targetUrl = $(this).attr("href");
		var id = $(this).attr("data-id");
		var nama = $(this).data("username");
		var date = $(this).data("date_used");
		var depart = $(this).data("nama_kategori");
		var title = $(this).data('approval') === 'approve' ? 'Setujui transport request ' + nama + date + depart + '?' : 'Tolak transport request ' + nama + date + depart + '?';
		var message = $(this).data('approval') === 'approve' ? 'Transport request yang disetujui tidak bisa dikembalikan lagi!' : 'Transport request yang ditolak tidak bisa dikembalikan lagi!';
		Swal.fire({
			title: title,
			text: message,
			type: 'warning',
			width: 500,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Oke',
			cancelButtonText: 'Batal',
		}).then((result) => {
			if (result.value) {
				location.href = targetUrl;
			}
		});
	});
	$(document).ready(function() {
		$('#myTable2').DataTable();
		$('#myTable3').DataTable();
	});





	function cetak(id_operational) {
		printElement(document.getElementById("printThis" + id_operational));

	}


	function printElement(elem) {
		var domClone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		window.print();
	}
</script>
