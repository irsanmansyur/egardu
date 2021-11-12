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

<div class="pd-20 card-box">
	<div class="pd-20">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<h3 class='box-title'>Approval Operational Gardu</h3>
			</div>
		</div>
	</div>
	<div class="tab">
		<ul class="nav nav-pills" role="tablist">
			<li class="nav-item">
				<a class="nav-link active text-blue" data-toggle="tab" href="#home5" role="tab" aria-selected="true">Waiting Approve Check In</a>
			</li>
			<li class="nav-item">
				<a class="nav-link  text-blue" data-toggle="tab" href="#home3" role="tab" aria-selected="true">Waiting Approve Check Out</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-blue" data-toggle="tab" href="#profile5" role="tab" aria-selected="false">Approved Check In</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-blue" data-toggle="tab" href="#profile6" role="tab" aria-selected="false">Approved Check Out</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-blue" data-toggle="tab" href="#contact5" role="tab" aria-selected="false">Rejected</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade show active" id="home5" role="tabpanel">
				<div class="pb-20">
					<table id="myTable" class="table table-bordered table-hover ">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Action</span></th>
							</tr>
						<tbody>
							<?php
							$no = 0;
							foreach ($waiting as $r) :
								$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

							?>
								<tr>
									<td style="font-size: 10px;"><?php echo ++$no; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
									<td style="font-size: 10px;"><?php echo $r->username; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
									<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_out != null) ? date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i') : ''; ?></td>
									<td>
										<?php
										$jamKeberangkatan = date('H:i:s', strtotime($r->time_in));
										if ($r->approval_sp_status == 'waiting') { ?>
											<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-check"></span></a>
										<?php } ?>
									</td>

								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
				<div class="tab-pane fade" id="home3" role="tabpanel">
				<div class="pb-20">
					<table id="myTable" class="table table-bordered table-hover ">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Action</span></th>
							</tr>
						<tbody>
							<?php
							$no = 0;
							foreach ($wait as $r) :
								$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

							?>
								<tr>
									<td style="font-size: 10px;"><?php echo ++$no; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
									<td style="font-size: 10px;"><?php echo $r->username; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
									<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_out != null) ? date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i') : ''; ?></td>
									<td>
										<?php
										$jamKeberangkatan = date('H:i:s', strtotime($r->time_in));
										if ($r->approval_sp_status == 'approved') { ?>
											<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-check"></span></a>
										<?php } ?>
									</td>

								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="profile5" role="tabpanel">
				<div class="table-responsive">
					<table class="table hover nowrap">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Action</span></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($approved as $r) :
								$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();


							?>
								<tr>
									<td style="font-size: 10px;"><?php echo ++$no; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
									<td style="font-size: 10px;"><?php echo $r->username; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
									<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
									<td><?php echo date('d F Y', strtotime($r->approval_sp_at)) . '<br>' . date('H:i', strtotime($r->approval_sp_at)); ?></td>
									<td>
										<?php
										$jamKeberangkatan = date('H:i:s', strtotime($r->time_in));
										if ($r->approval_sp_status == 'approved') { ?>
											<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-eye"></span></a>
										<?php } ?>
									</td>
								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="profile6" role="tabpanel">
				<div class="table-responsive">
					<table class="table hover nowrap">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Action</span></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($approved as $r) :
								$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();


							?>
								<tr>
									<td style="font-size: 10px;"><?php echo ++$no; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
									<td style="font-size: 10px;"><?php echo $r->username; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
									<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
									<td><?php echo date('d F Y', strtotime($r->approval_sp_at)) . '<br>' . date('H:i', strtotime($r->approval_sp_at)); ?></td>
									<td>
										<?php
										$jamKeberangkatan = date('H:i:s', strtotime($r->time_in));
										if ($r->approval_sp_status == 'approved') { ?>
											<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-eye"></span></a>
										<?php } ?>
									</td>
								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="contact5" role="tabpanel">
				<div class="table-responsive">
					<table class="table hover nowrap">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Action</span></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($rejected as $r) :
							?>
								<tr>
									<td style="font-size: 10px;"><?php echo ++$no; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>
									<td style="font-size: 10px;"><?php echo $r->username; ?></td>
									<td style="font-size: 10px;"><?php echo $r->nip; ?></td>
									<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?></td>
									<td style="font-size: 10px;"><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
									<td></td>
									<!-- <td><?php echo $r->approval_at != null ? date('d F Y', strtotime($r->approval_at)) . '<br>' . date('H:i', strtotime($r->approval_at)) : ''; ?></td> -->
									<td><?php echo date('d F Y', strtotime($r->approval_sp_at)) . '<br>' . date('H:i', strtotime($r->approval_sp_at)); ?></td>
									<td>
									<a data-toggle="modal" data-target="#showModalPdf<?= $r->id_operational ?>" class="btn btn-info btn-sm" style="width: 45%;"><span class="fa fa-eye"></span></a>

									</td>
								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>




<?php
$no = 0;
//var_dump($record); die();

foreach ($AllData as $r) {
	$nama_driver = '';




?>

	<div class="modal fade" id="showModalPdf<?= $r->id_operational; ?>" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 1000%; height:200%;">
			<div class="modal-content" style="width: 200%;">
				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="data-table table hover nowrap">
						<thead>

							<tr>
								<th>No </th>
								<th>Nama Gardu</th>
								<th>Nama Petugas</th>
								<th>Nip</th>
								<th>Pekerjaan</th>
								<th>Check In</th>

							</tr>

						</thead>
						<tbody>
							<tr>
								<td style="font-size: 10px;"><?php echo ++$no; ?></td>
								<td style="font-size: 10px;"><?php echo $r->nama_gardu; ?></td>

								<td style="font-size: 10px;"><?php echo $r->username; ?></td>
										<td><?php echo $r->nip; ?></td>
										<td style="font-size: 10px;"><?php echo $r->time_in; ?></td>
								<td style="font-size: 10px;"><?php echo $r->pekerjaan; ?>
							</tr>
						</tbody>
					</table>

				</div>
				<div class="modal-footer">

					<?php
					if ($r->approval_sp_status == 'waiting') {

						$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();


					?>
						<a href="<?= base_url('index.php/Approval/update/' . $r->id_operational . '/reject') ?>" class="btn btn-success btn-sm btn-approval" data-approval="reject" data-username="<?= $user->username ?>-"><span class="fa fa-times"></span> Reject </a>&nbsp;
						<a href="<?= base_url('index.php/Approval/update/' . $r->id_operational . '/approve') ?>" class="btn btn-success btn-sm btn-approval" data-approval="approve" data-username="<?= $user->username ?>-" style="float:right;margin-right: 13px;"><span class="fa fa-check"></span> Approve </a>
					<?php } else { ?>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					<?php } ?>


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
