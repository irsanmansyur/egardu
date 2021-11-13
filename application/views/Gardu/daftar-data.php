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
				<?php $this->load->view("Template/page-header", ['title' => "Daftar Distribusi Gardu"]); ?>
				<!-- Content -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="pb-20">
						<div class="pd-20">
							<div class="row">
								<a>Report Distributional Gardu<a />
							</div>
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-6 ">
									<?php
									if (user_role()->nama_akses != 'Management' || $this->session->userdata('role') != 4 || user_role()->id_akses != 4) {
										echo anchor('Gardu/export', 'Download', array('class' => 'btn btn-success'));
									}
									?>
								</div>
								<div class="col-md-6  ">
									<?php
									if (user_role()->nama_akses != 'Management' || $this->session->userdata('role') != 4 || user_role()->id_akses != 4) {
										echo anchor('Gardu/post', 'Tambah Data', array('class' => 'btn btn-success'));
									}
									?>

								</div>
							</div>
						</div>
						<br>
						<?php if ($this->session->flashdata("image")) : ?>
							<script type="text/javascript">
								alert("<?= $this->session->flashdata("image"); ?>")
							</script>
						<?php endif; ?>
						<div class="table-responsive min-vh-100">
							<table class="data-table table table-striped  border">
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
								</thead>
								<tbody>
									<?php
									$no = 0;
									foreach ($record as $r) :
										$tanggal1 = new DateTime($r->date_request);
										$tanggal2 = new DateTime();
										$perbedaan = $tanggal2->diff($tanggal1);
										$btn_time_in = ($r->time_in == NULL) ? '<button type="button" onclick="time_in(' . $r->id_operational . ')" data-target="#modal-checkin" data-toggle="modal"  class="btn btn-primary">Check IN</button> ' : date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i');
										$btn_time_out = ($r->time_out == NULL) ? '<button type="button" disabled onclick="time_in(' . $r->id_operational . ')"  data-toggle="modal" data-target="#modal-checkin" class="btn btn-primary">Check Out</button> ' : date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i');

										$btn_timeOut = ($r->time_in == NULL  && $r->time_out == NULL) ? '<button type="button"  onclick="time_out(' . $r->id_operational . ')" data-toggle="modal" data-target="#myModal' . $r->id_operational . '" class="btn btn-primary">Check Out</button> ' : $btn_time_out;

										$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

									?>

										<tr>
											<td class="table-plus"><?php echo ++$no; ?></td>
											<td><?php echo $r->date_request; ?></td>
											<td><?php echo $r->nama_gardu; ?></td>
											<td><?php echo $r->username; ?></td>
											<td><?php echo $r->nip; ?></td>
											<td><?php echo $r->pekerjaan; ?>
											<td style="font-size: 10px; width: 1%">
												<?php if ($r->time_in == null && $perbedaan->d > 0) : ?>
													00:00:00
												<?php else : ?>

													<?= $btn_time_in ?>
												<?php endif; ?>
											</td>
											<td style="font-size: 10px; font-size: 10px;">
												<?php if ($r->time_out == null && $perbedaan->d > 0) : ?>
													00:00:00
												<?php elseif ($r->time_out == NULL && $r->time_in == NULL) : ?>
													<button type="button" disabled class="btn btn-primary">Check Out</button>
												<?php elseif ($r->time_out == NULL && $r->time_in != NULL) : ?>
													<button type="button" data-toggle="modal" data-target="#myOut" data-id="<?= $r->id_operational; ?>" onclick="openOut(<?= $r->id_operational; ?>)" class="btn btn-primary">Check Out</button>
												<?php else : ?>
													<div class="d-flex justify-content-center align-items-center">
														<span data-toggle="modal" data-target="#zoom-image" onclick="imageZoom('<?= base_url("uploads/" . $r->image) ?>')">
															<img style="width:60px;height:60px;cursor:zoom-in;" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
														</span>
														<span> <?= date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i'); ?></span>
													</div>

												<?php endif; ?>
											</td>

											</td>
											<td>
												<div class="dropdown">
													<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
														<i class="dw dw-more"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
														<!-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> -->
														<table class="table">
															<tr>
																<th>pekerjaan</th>
															</tr>

															<tr>
																<td><?php echo $r->pekerjaan; ?></td>
															</tr>
														</table>
														<?php if (($r->time_in == null && $perbedaan->d > 0) || $r->time_in != null) : ?>
														<?php else : ?>
															<a href="<?= site_url('Gardu/edit/' . $r->id_operational); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o fa-lg"></i></a>
														<?php endif; ?>
														<a href="<?= site_url('Gardu/hapus/' . $r->id_operational); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a>
														</a>
													</div>
												</div>

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
				<div id="myOut" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<form id="frmTimeout" enctype="multipart/form-data" method="post" action="<?= base_url() ?>index.php/Gardu/update_time_out">
							<!-- Modal content-->
							<input type="hidden" name="id_operational" id="id_operational_out">
							<div class="modal-content">
								<div class="modal-body">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#webcam" role="tab" aria-controls="webcam" aria-selected="true">Webcam</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="browse-tab" data-toggle="tab" href="#browse" role="tab" aria-controls="browse" aria-selected="false">Browse</a>
										</li>
									</ul>
									<div class="tab-content my-3" id="myTabContent">
										<div class="tab-pane fade show active" id="webcam" role="tabpanel" aria-labelledby="home-tab">
											<div class="form-group">
												<input type=button value="Take Snapshot" class="btn btn-primary" onClick="take_snapshot()">
												<input type="hidden" name="image" class="image-tag">
											</div>
										</div>
										<div class="tab-pane fade" id="browse" role="tabpanel" aria-labelledby="browse-tab">
											<div class="form-group my-2">
												<label>Pilih Gambar</label>
												<div class="custom-file border" style="overflow: hidden;">
													<input type="file" class="custom-file-input image-x" accept="image/*">
													<label class="image-label custom-file-label">Choose file</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group my-2">
										<div id="my_camera" class="border shadow-sm h-auto"></div>
										<div id="results"></div>
									</div>
									<div class="form-group">
										<label>Jam</label>
										<input class="form-control time-picker td-input" placeholder="time" readonly required id="time_out" name="time" value="<?php echo date('H:i '); ?>">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
									<!-- <button type="submit" onclick="prosesUpdateTime_out()" class="btn btn-primary">Submit</button> -->
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="modal-checkin" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<form id="frmTimeIn" method="post" action="<?= base_url("gardu/update_time_in") ?>">
							<input type="hidden" name="id_operational_in" id="id_operational_in">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body">
									<input type="hidden" name="type" value="in" />
									<div class="form-group">
										<label>Jam</label>
										<input value="<?php echo date('H:i '); ?>" readonly class="form-control time-picker td-input" required name="time" id="time_in">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
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
									<img src="" id="imagepreview" data-dismiss="modal" style="cursor: zoom-out">
								</div>
							</div>
						</div>
					</div>
				</div>
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
		$("#browse-tab").on("click", () => {
			$("#my_camera").html("");
			Webcam.unfreeze();
			Webcam.off()
		})
		$("#home-tab").on("click", () => {
			Webcam.set({
				width: 400,
				height: 390,
				image_format: 'jpeg',
				jpeg_quality: 90
			});
			Webcam.attach('#my_camera');
		})

		function openCamera() {
			Webcam.set({
				width: 400,
				height: 390,
				image_format: 'jpeg',
				jpeg_quality: 90
			});
			Webcam.attach('#my_camera');
		}

		function openOut(id) {
			Webcam.set({
				width: 400,
				height: 390,
				image_format: 'jpeg',
				jpeg_quality: 90
			});
			Webcam.attach('#my_camera');
			$("#id_operational_out").val(id);
		};

		function time_in(id) {
			$("#id_operational_in").val(id);
			$("#results").html("")
			$("#my_camera").html("")
		};
		$(".image-x").on("change", function() {
			$("#results").html("")
			file = this.files[0];
			$(".image-label").text(file.name)
			if (file.type.startsWith('image/')) {
				const img = document.createElement("img");
				img.classList.add("obj");
				img.file = file;
				img.name = "image"
				img.style.maxHeight = "200px"
				$("#results").html(img); //  the content will be displayed.

				const InpImg = document.createElement("input");
				InpImg.name = "image";
				InpImg.type = "hidden"
				InpImg.classList.add("d-none")
				InpImg.value = img.getAttribute("src");

				const reader = new FileReader();
				reader.onload = (function(aImg) {
					return function(e) {
						InpImg.value = e.target.result;
						aImg.src = e.target.result;
					};
				})(img);
				reader.readAsDataURL(file);
				$("#results").append(InpImg)
			}


		})

		function take_snapshot() {
			// preload shutter audio clip
			var shutter = new Audio();
			shutter.autoplay = true;
			shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
			shutter.play();
			Webcam.snap(function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
			});
		}
	</script>
</body>

</html>
