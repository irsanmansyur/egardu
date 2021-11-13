<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url('deskapp/'); ?>src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('deskapp/'); ?>src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<?php $this->load->view("Template/head", ["page_title" => "Report Distributional Gardu"]); ?>
	<style>
		.child .dtr-details {
			width: 100%;
		}
	</style>
</head>

<body>
	<?php $this->load->view("Template/preloader"); ?>
	<?php $this->load->view("Template/header"); ?>
	<?php $this->load->view("Template/right-sidebar"); ?>
	<?php $this->load->view("Template/left-sidebar"); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<?php $this->load->view("Template/page-header", ['title' => "Approval Operational Gardu"]); ?>
				<!-- Content -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="pb-20">
						<?php if ($this->session->flashdata("image")) : ?>
							<script type="text/javascript">
								alert("<?= $this->session->flashdata("image"); ?>")
							</script>
						<?php endif; ?>
						<div class="table-responsive pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">No</th>
										<th>Tanggal Masuk</th>
										<th>Nama Gardu</th>
										<th>Nama Petugas</th>
										<th>Nip</th>
										<th>Pekerjaan</th>
										<th>Check In</th>
										<th>Check Out</th>
										<th class="datatable-nosort">Action</th>
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
										<tr>
											<td class="table-plus"><?php echo ++$no; ?></td>
											<td><?php echo $r->date_request; ?></td>

											<td><?php echo $r->nama_gardu; ?></td>
											<td><?php echo $r->username; ?></td>
											<td><?php echo $r->nip; ?></td>
											<td><?php echo $r->pekerjaan; ?></td>
											<td><?php echo ($r->time_in != null) ? date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i') : ''; ?></td>
											<td> <span data-toggle="modal" data-target="#zoom-image" onclick="imageZoom('<?= base_url("uploads/" . $r->image) ?>')">
													<img style="width:60px;height:60px;cursor:zoom-in;" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
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
						</div>
					</div>
				</div>
				<!-- End Kontent -->

				<!-- Modal  -->
				<div id="zoom-image" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<style>
								.modal-previewImg:hover #imagepreview {
									transform: scale(1.5);
									-ms-transform: scale(1.5);
									/* IE 9 */
									-moz-transform: scale(1.5);
									/* Firefox */
									-webkit-transform: scale(1.5);
									/* Safari and Chrome */
									-o-transform: scale(1.5);
									/* Opera */
								}
							</style>
							<div class="modal-body">
								<div class="modal-previewImg" style="overflow: auto;text-align:center ">
									<center><img src="" id="imagepreview" data-dismiss="modal" style="cursor: zoom-out"></center>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($AllData as $r) : ?>
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
												<td><?php echo $r->date_request; ?></td>
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
									<div class="text-center">
										<img style="" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
									</div>
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
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<!-- end modal  -->
			</div>
			<?php $this->load->view("Template/footer"); ?>
		</div>
	</div>
	<?php $this->load->view("Template/script"); ?>
	<script src="<?= base_url("deskapp/"); ?>src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url("deskapp/"); ?>src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url("deskapp/"); ?>src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url("deskapp/"); ?>src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

	<script src="<?= base_url("deskapp/src/plugins/webcam/webcam.js"); ?>"></script>
	<script>
		$('document').ready(function() {
			$('.data-table').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
				],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search",
					paginate: {
						next: '<i class="ion-chevron-right"></i>',
						previous: '<i class="ion-chevron-left"></i>'
					}
				},
			});
		})

		function imageZoom(src) {
			$("#imagepreview").attr("src", src);
		}
	</script>
</body>

</html>
