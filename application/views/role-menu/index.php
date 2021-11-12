
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h3 class='box-title'>Role Menu</h3>
			</div>
			<div class="col-md-6 col-sm-12 text-right">
			</div>
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table hover nowrap">
			<thead>
				<tr >
					<th>Role</th>
					<th><i class="icon-copy fa fa-gear" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 0;
				foreach ($roles as $role) {  ?>
					<tr>
						<td class="text-left"><?= $role->nama_akses ?></td>
						<td>
							<a href="<?= base_url('role_menu/edit/' . $role->id_akses) ?>" class="btn btn-primary">Edit Menu</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>

			<a href="<?= base_url('Operator') ?>" class="btn btn-default">Kembali</a>
		</table>
	</div>
</div>
