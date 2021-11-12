<div class="left-side-bar">
	<div class="brand-logo">
		<a href="index.html">
			<img src="<?= base_url('deskapp/'); ?>vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
			<img src="<?= base_url('deskapp/'); ?>vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll">
		<div class="sidebar-menu">
			<ul id="accordion-menu">
				<?php foreach (getMenu() as $menu) : ?>
					<li class="<?= $menu->child_menu ? "dropdown" : "no-dropdown"; ?>">
						<a href="<?= $menu->child_menu ? "javascript:;" : base_url($menu->name); ?>" class="dropdown-toggle <?= $menu->child_menu ? "arrow" : "no-arrow"; ?>">
							<span class="<?= $menu->icon ?>"></span><span class="mtext"><?= $menu->display_name ?></span>
						</a>
						<?php if ($menu->child_menu) : ?>
							<ul class="submenu">
								<?php foreach ($menu->child_menu as $cm) : ?>
									<li><a href="<?php echo base_url($cm->name) ?>"><?= $cm->display_name ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
