<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<style type="text/css">
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
</style>
<?php if ($this->session->flashdata('message')) { ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-check"></i>Berhasil</h4>
			<p><?php echo $this->session->flashdata('message'); ?></p>
		</div>
	</div>
<?php } else {
} ?>



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
		</thead>
		<tbody>
			<?php
			$no = 0;
			foreach ($record as $r) :
				$tanggal1 = new DateTime($r->date_request);
				$tanggal2 = new DateTime();

				$perbedaan = $tanggal2->diff($tanggal1);


				$btn_time_in = ($r->time_in == NULL) ? '<button type="button" onclick="time_in(' . $r->id_operational . ')" data-toggle="modal"  class="btn btn-primary">Check IN</button> ' : date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i');
				$btn_time_out = ($r->time_out == NULL) ? '<button type="button" disabled  data-toggle="modal" data-target="#myModal2' . $r->id_operational . '" class="btn btn-primary">Check Out</button> ' : date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i');
				$btn_timeOut = ($r->time_in == NULL  && $r->time_out == NULL) ? '<button type="button"  onclick="time_out(' . $r->id_operational . ')" data-toggle="modal" data-target="#myModal' . $r->id_operational . '" class="btn btn-primary">Check Out</button> ' : $btn_time_out;

				$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

			?>

				<tr style="background: white; padding-bottom:0px; ">
					<td class="table-plus" style="padding-left: 1px; font-size: 10px; width: 1%; height:10%;"><?php echo ++$no; ?></td>
					<td style="padding-left: 1px; margin-bottom: 5%; padding-bottom:1px; font-size: 10px; width: 1%; height:5px;"><?php echo $r->date_request; ?></td>
					<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->nama_gardu; ?></td>
					<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->username; ?></td>
					<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->nip; ?></td>
					<td style="padding-left: 1px; font-size: 10px; padding-bottom:5px;  width: 1%"><?php echo $r->pekerjaan; ?>

						<?php
						?>
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
								<span>
									<img style="width:60px;height:60px" class="mr-3" src="<?= base_url("uploads/" . $r->image); ?>" alt="">
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

								<a class="dropdown-item">
									<table>
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

<?php foreach ($record as $r) : ?>
	<div id="modalOut<?= $r->id_operational; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<form id="frmTimeout" method="post" action="<?= base_url() ?>index.php/Gardu/update_time">
				<!-- Modal content-->
				<input type="hidden" name="id_vehicle" id="id_vehicleOut">
				<input type="hidden" name="id_operational" id="id_report_requestOut">
				<div class="modal-content">

					<div class="modal-body">
						<input type="hidden" name="type" value="out" />
						<!-- <label for="birthdaytime">Input Date :</label>
					 <input class="form-control" type="date" id="birthdaytime" name="date"> -->

						<input type="text" value="<?php echo date('H:i '); ?>" class="form-control" required id="time_out" name="time" />

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
<?php endforeach; ?>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form id="frmTimeout" method="post" action="<?= base_url() ?>index.php/Gardu/update_time">
			<!-- Modal content-->
			<input type="hidden" name="id_vehicle" id="id_vehicleOut">
			<input type="hidden" name="id_operational" id="id_report_requestOut">
			<div class="modal-content">

				<div class="modal-body">
					<input type="hidden" name="type" value="out" />
					<!-- <label for="birthdaytime">Input Date :</label>
						<input class="form-control" type="date" id="birthdaytime" name="date"> -->

					<input type="text" value="<?php echo date('H:i '); ?>" class="form-control" required id="time_out" name="time" />

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
<div id="myModal2" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form id="frmTimeIn" method="post" action="<?= base_url() ?>index.php/Gardu/update_time">
			<!-- Modal content-->
			<input type="hidden" name="id_vehicle" id="id_vehicleIn">
			<input type="hidden" name="id_operational" id="id_report_requestIn">
			<div class="modal-content">

				<div class="modal-body">
					<input type="hidden" name="type" value="in" />
					<!-- <label for="birthdaytime">Input Date :</label>
						<input class="form-control" type="date" id="birthdaytime" name="date"> -->

					<input type="text" value="<?php echo date('H:i '); ?>" readonly class="form-control" required name="time" id="time_in" />

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
					<!-- <button type="button" onclick="prosesUpdateTime()" class="btn btn-primary">Submit</button> -->
				</div>
			</div>
		</form>
	</div>
</div>




<div id="myOut" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<form id="frmTimeout" method="post" action="<?= base_url() ?>index.php/Gardu/update_time_out">
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
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="webcam" role="tabpanel" aria-labelledby="home-tab">
							<div class="form-group">
								<div id="my_camera" class="border shadow-sm"></div>
								<input type=button value="Take Snapshot" class="btn btn-primary" onClick="take_snapshot()">
								<input type="hidden" name="image" class="image-tag">
							</div>
						</div>
						<div class="tab-pane fade" id="browse" role="tabpanel" aria-labelledby="browse-tab">...</div>
					</div>
					<div class="col-md-6">

						<br />

					</div>
					<div class="col-md-6">
						<div id="results">Silahkan Ambil Gambar.</div>
					</div>
					<input type="hidden" name="type" value="out" />
					<!-- <label for="birthdaytime">Input Date :</label>
						<input class="form-control" type="date" id="birthdaytime" name="date"> -->
					<label for="birthdaytime">Check Out Time :</label>
					<input value="<?php echo date('H:i '); ?>" class="form-control" readonly required id="time_out" name="time" />

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script>
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

	function take_snapshot() {
		Webcam.snap(function(data_uri) {
			$(".image-tag").val(data_uri);
			document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
		});
	}
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#bulan').select2();
		$('#year').select2();
	});



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

	var TotalRecord = $('#TotalRecord').val();




	var TotalRecord = $('#TotalRecord').val();

	$(function() {
		// $('#startTime, #endTime').datetimepicker({
		//     format: 'HH:mm',
		//     pickDate: false,
		//     pickSeconds: false,
		//     pick12HourFormat: false
		// });
	});
	// var timepicker_in = new TimePicker('time_in', {
	//   lang: 'en',
	//   theme: 'dark'
	// });
	//
	// var input = document.getElementById('time');
	//
	// timepicker_in.on('change', function(evt) {
	//   console.log('in');
	//
	//   var value = (evt.hour || '00') + ':' + (evt.minute || '00');
	//   evt.element.value = value;
	//
	// });
	// $(function () {
	//   $('#startTime, #endTime').datetimepicker({
	//       format: 'HH:mm',
	//       pickDate: false,
	//       pickSeconds: false,
	//       pick12HourFormat: false
	//   });
	// });

	var timepicker = new TimePicker(['time_in', 'time_out'], {
		lang: 'en',
		theme: 'dark'
	});

	var input = document.getElementById('time');

	timepicker.on('change', function(evt) {
		var value = (evt.hour || '00') + ':' + (evt.minute || '00');
		evt.element.value = value;

	});
	//   $(function () {
	//     $('#startTime, #endTime').datetimepicker({
	//         format: 'HH:mm',
	//         pickDate: false,
	//         pickSeconds: false,
	//         pick12HourFormat: false
	//     });
	// });
	// var timepicker = new TimePicker(['time_in','time_out'], {
	//   lang: 'en',
	//   theme: 'dark'
	// });
	//
	// var input = document.getElementById('time');
	//
	// timepicker.on('change', function(evt) {
	//
	//   var value = (evt.hour || '00') + ':' + (evt.minute || '00');
	//   evt.element.value = value;
	//
	// });




	function time_in(id, id_vehicle) {

		$('#id_report_requestIn').val(id);
		$('#myModal2').modal('show');


	}

	function time_out(id, id_vehicle) {

		$('#id_report_requestOut').val(id);
		$('#myModal').modal('show');


	}

	function prosesUpdateTime() {
		if ($('#time_in').val() == "") {

			$("#errortimeIn").hide();
			document.getElementById("time_in").style.borderColor = "#d5d5d5";

			if ($("#time_in").val() == "") {
				$("#errortimeIn").show();
				document.getElementById("time_in").style.borderColor = "#FF0000";
				return false;
			}

		}
		var url = '<?= base_url() ?>index.php/Gardu/update_time';
		var formData = new FormData($("#frmTimeIn")[0]);

		$('#myModal2').modal('hide');

		$.ajax({
			type: "POST",
			url: url,
			processData: false,
			contentType: false,
			data: formData,
			success: function(data) {

				location.reload();

			}
		});
	}

	function prosesUpdateTime_out() {
		if ($('#time_out').val() == "") {

			$("#errortimeout").hide();
			document.getElementById("time_out").style.borderColor = "#d5d5d5";

			if ($("#time_out").val() == "") {
				$("#errortimeout").show();
				document.getElementById("time_out").style.borderColor = "#FF0000";
				return false;
			}

		}
		var url = '<?= base_url() ?>index.php/Gardu/update_time';
		var formData = new FormData($("#frmTimeout")[0]);

		$('#myModal').modal('hide');

		$.ajax({
			type: "POST",
			url: url,
			processData: false,
			contentType: false,
			data: formData,
			success: function(data) {

				location.reload();

			}
		});
	}
</script>
