
	<!-- horizontal Basic Forms Start -->
	<div class="pd-20 card-box mb-30">
		<div class="clearfix">
			<div class="pull-left">
				<h4 class="text-blue h4">Edit Role Menu</h4>
			</div>
		</div>
		<form method="post" action="<?= base_url('role_menu/update/' . $role->id_akses) ?>">
			<div class="form-group row">
				<label class="col-md-1">Role</label>
				<div class="col-md-5">
					<input type="text" class="form-control" value="<?= $role->nama_akses ?>" disabled />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1">Menu</label>
				<div class="col-md-11">
					<?php foreach($menus as $menu): ?>
						<div class="form-group" style="margin-bottom: 0px;">
							<input type="checkbox" name="menu_id[]" value="<?= $menu->id ?>" id="<?= $menu->id ?>" <?= in_array($menu->id , $role_menu) ? 'checked' : '' ?> />
							<label for="<?= $menu->id ?>"><?= $menu->display_name ?></label>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1"></label>
				<div class="col-md-5">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="<?= base_url('role_menu') ?>" class="btn btn-default">Kembali</a>
				</div>
			</div>
		</form>
	</div>
	<!-- horizontal B	asic Forms End -->
