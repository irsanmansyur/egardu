<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Distribution Operational Mobile Apps</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>deskapp/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>deskapp/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>deskapp/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>deskapp/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>

</head>
<?php $role = $this->session->userdata('role');
$pieces = explode(",", $role);
$index = 0;
foreach ($pieces as $key) {
	if ($key == 5 || $key == 6 || $key == 4) {
		$index = 2;
	}
}
?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?= base_url() ?>deskapp/vendors/images/listrindo.jpeg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>


	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu">
			</div>

			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>

			<div class="col-md-12">
				<a>Aplikasi Ijin Akses Aset/Gardu Distribusi<a />


			</div>
		</div>
		<div class="header-right">
			<?php
			$foto = $this->session->userdata['foto'];
			$site = '';
			$role = $this->session->userdata('role');
			$role = explode(',', $role);
			$arr_role = [];
			for ($i = 0; $i < count($role); $i++) {
				$arr_role[] = $role[$i];
			}
			$getRole = $this->db->query("SELECT * FROM role where id_akses in ('" . implode("','", $arr_role) . "') ")->result_array();
			?>

			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo base_url('uploads/operator/') . $foto; ?>" alt="">
						</span>
						<span class="user-name"><?= $this->session->userdata['username']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="<?php echo base_url() ?>index.php/auth/logout"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="">
				<img src="<?= base_url(); ?>deskapp/vendors/images/listrindo.jpeg" alt="" class="dark-logo">
				<img src="<?= base_url(); ?>deskapp/vendors/images/listrindo.jpeg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<?php foreach (getMenu() as $menu) : ?>
						<?php $classMenu = '';
						if ($menu->child_menu) {
							$classMenu = 'class="dropdown"';
						}
						?>
						<li <?= $classMenu; ?>>
							<a href="<?php if ($menu->child_menu) {
													echo '#';
												} else {
													echo base_url($menu->name);
												}
												?>" class="dropdown-toggle no-arrow">
								<span class="<?= $menu->icon ?>"></span><span class="mtext"><?= $menu->display_name ?></span>
							</a>

							<?php if ($menu->child_menu) { ?>
								<ul class="submenu">
									<?php foreach ($menu->child_menu as $cm) { ?>
										<li><a href="<?php echo base_url($cm->name) ?>"><?= $cm->display_name ?></a></li>
									<?php } ?>
								</ul>
							<?php } ?>


						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<?php echo $contents ?>
		</div>
	</div>



	<!-- js -->

	<script src="<?= base_url(); ?>deskapp/vendors/scripts/Chart.js"></script>

	<script src="<?= base_url(); ?>deskapp/vendors/scripts/core.js"></script>

	<script src="<?= base_url(); ?>deskapp/vendors/scripts/script.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/vendors/scripts/process.js"></script>
	<script src="<?= base_url(); ?>deskapp/vendors/scripts/layout-settings.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>deskapp/src/plugins/datatable-setting.js"></script>

	<!-- Datatable Setting js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="<?= base_url(); ?>deskapp/vendors/scripts/dashboard.js"></script>
	<!-- add sweet alert js & css in footer -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$("body").on("click", ".btn-danger", function(e) {
			e.preventDefault();
			var targetUrl = $(this).attr("href");
			var id = $(this).attr("data-id");
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: "Data yang dihapus tidak bisa dikembalikan lagi!",
				icon: 'warning',
				width: 500,
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Hapus',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.value) {
					var postData = {};
					postData["id"] = id;
					$.post(targetUrl, postData, function(result) {
						Swal.fire(
							"dihapus",
							"Data berhasil dihapus!",
							"success",
						).then(function() {
							location.reload();
						});
					});
				}
			});
		});

		$(document).ready(function() {
			var wrapper = $("#input_fields_wrap"); //Fields wrapper
			var add_button = $("#add"); //Add button ID

			var x = 1; //initlal text box count
			$(add_button).click(function(e) { //on add input button click
				e.preventDefault();
				wrapper.append('<div><input class="form-control form-inline" type="text" name="note[]"/><a href="#" id="delete">Remove</a></div>'); //add input box
			});

			$(wrapper).on("click", "#delete", function(e) { //user click on remove text
				e.preventDefault();
				$(this).parent('div').remove();
				x--;
			})
		});
	</script>
</body>

</html>
