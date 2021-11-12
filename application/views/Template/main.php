<!DOCTYPE html>
<html>

<head>
	<?php $this->load->view("template/head"); ?>
</head>

<body>
	<?php $this->load->view("template/preloader"); ?>
	<?php $this->load->view("template/header"); ?>
	<?php $this->load->view("template/right-sidebar"); ?>
	<?php $this->load->view("template/left-sidebar"); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<?php $this->load->view("template/page-header"); ?>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				</div>
			</div>
			<?php $this->load->view("template/footer"); ?>
		</div>
	</div>
	<?php $this->load->view("template/script"); ?>
</body>

</html>
