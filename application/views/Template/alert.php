<?php
if ($this->session->flashdata("message")) {
	$bg = "alert-primary";
	$msg = $this->session->flashdata("message");
} else if ($this->session->flashdata("danger") || $this->session->flashdata("error")) {
	$bg = "alert-danger";
	$msg = $this->session->flashdata("danger");
} else if ($this->session->flashdata("warning")) {
	$bg = "alert-warning";
	$msg = $this->session->flashdata("warning");
} else if ($this->session->flashdata("info")) {
	$bg = "alert-info";
	$msg = $this->session->flashdata("info");
} else if ($this->session->flashdata("success")) {
	$bg = "alert-success";
	$msg = $this->session->flashdata("success");
} ?>
<?php if (isset($msg)) : ?>
	<div class="page-header alert <?= $bg; ?>">
		<?= $msg; ?>
	</div>
<?php endif; ?>
