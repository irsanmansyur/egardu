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
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h4 class='box-title'>Report Distributional Gardu</h4>
			</div>
			<div class="col-md-6 col-sm-12 text-right">
				<?php
				echo anchor('Gardu/post', 'Tambah Data', array('class' => 'btn btn-success'));
				?>
			</div>
		</div>
	</div>

	<div class="pb-20">
		<table id="myTable" class="data-table table hover nowrap">

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
						$btn_time_in = '';
						$btn_time_out = '';
						$btn_timeOut = '';

						$btn_time_in = ($r->time_in == NULL) ? '<button type="button" onclick="time_in(' . $r->id_operational . ')" data-toggle="modal"  class="btn btn-primary">Check IN</button> ' : date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i');
						$btn_time_out = ($r->time_out == NULL) ? '<button type="button" disabled  data-toggle="modal" data-target="#myModal2' . $r->id_operational . '" class="btn btn-primary">Check Out</button> ' : date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i');
						$btn_timeOut = ($r->approval_sp_status == 'approved' && $r->time_in != NULL && $r->time_out == NULL) ? '<button type="button"  onclick="time_out(' . $r->id_operational . ')" data-toggle="modal" data-target="#myModal' . $r->id_operational . '" class="btn btn-primary">Check Out</button> ' : $btn_time_out;

						$user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

					?>

						<tr>
							<td class="table-plus"><?php echo ++$no; ?></td>
							<td><?php echo $r->date_request; ?></td>
							<td><?php echo $r->nama_gardu; ?></td>
							<td><?php echo $r->username; ?></td>
							<td><?php echo $r->nip; ?></td>
							<td><?php echo $r->pekerjaan; ?>
							<td style="font-size: 10px;"><?= $btn_time_in ?> </td>
							<td style="font-size: 10px;"><?= $btn_timeOut ?></td>

							</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<!-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> -->

										<a class="dropdown-item"><?php
																	echo anchor(site_url('Gardu/edit/' . $r->id_operational), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;', array('title' => '', 'class' => 'btn btn-sm btn-warning'));
																	echo '&nbsp';
																	echo anchor(site_url('Gardu/hapus/' . $r->id_operational), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;', 'title="" class="btn btn-sm btn-danger "');
																	?> </a>

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
						<label for="birthdaytime">Input Time :</label>
						<input type="time" class="form-control" required id="time_out" name="time" />

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
						<label for="birthdaytime">Input Time :</label>
						<input type="time" class="form-control" required name="time" id="time_in" />

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

</div>

<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
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
