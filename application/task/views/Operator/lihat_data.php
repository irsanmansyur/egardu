
<div class="card-box mb-30">
	<div class="pd-20">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h3 class='box-title'>Management User</h3>
			</div>
			<div class="col-md-6 col-sm-12 text-right">
				<?php echo anchor('User/post', 'Tambah Data', array('class' => 'btn btn-success'));
				// echo anchor('role_menu', 'Role Menu', array('class' => 'btn btn-primary', 'style' => 'margin-left:5px'));
				?>
			</div>
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table hover nowrap">
			<thead>
				<tr >
					<th>No</th>
						<th>Nip </th>
					<th>Nama Lengkap </th>
					<th>Username </th>
					<th>Nama Atasan</th>
					<th>Role</th>
					<th>Foto</th>
					<th><i class="icon-copy fa fa-gear" aria-hidden="true"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no_urut = 1;
				// var_dump($record);exit();
				foreach ($record as $operator) {?>
				<tr>
					<td><?= $no_urut++; ?></td>
					<td><?php echo $operator->nip ?></td>
					<td><?php echo $operator->nama_lengkap ?></td>
					<td><?php echo $operator->username ?></td>
					<td><?php echo $operator->supervisor_name ?></td>
					<?php
					$sql ="SELECT * FROM `role` where `role`.`id_akses` in ($operator->id_akses)";
						$query = $this->db->query($sql);
						$no = $query->num_rows();
						?>
					<td>
						<?php
							$arr_role = [];
							foreach($query->result() as $row){
								$arr_role[] = $row->nama_akses;
							}

							echo implode(', ', $arr_role);
						?>
					</td>
					<td>
						<a href="<?php echo ('uploads/operator/' . $operator->foto); ?>" class="image-link">
							<img src="<?php echo ('uploads/operator/' . $operator->foto); ?>" alt="" style="width:30px;height:30px">
						</a>
					</td>
					<td>
						<?php
							echo anchor(site_url('User/edit/' . $operator->id_user), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
							echo '&nbsp';		?>
							<a onclick="return confirm('apakah anda yakin ?')" href="<?= base_url('index.php/User/hapus/' . $operator->id_user) ?>" style="background-color:red; color:white; border:1px solid red;" class="btn btn-secondary btn-xs"><span class="fa fa-trash"></span> </a>

					</td>



				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
