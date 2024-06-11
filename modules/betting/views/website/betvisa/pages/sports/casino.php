	<?php $website =  $this->db->get_where(db_prefix() . 'website')->row() ?>



	<div id="main-perent" class="align-items-start">
		<div id="" class="nav nav-pills p-1 sdfsdfs casinos-perent " id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-image:url('<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/sports/nav_bg.png') ?>');">
			<?php if ($website->casino_logo_1_status == 1) { ?>
				<button class="nav-link active p-3" id="v-pills-popular-tab" data-bs-toggle="pill" data-bs-target="#v-pills-popular" type="button" role="tab" aria-controls="v-pills-popular" aria-selected="true">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_1_name ? $website->casino_logo_1_name : 'Popular' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_1) ?>" />
				</button>
			<?php } ?>
			<?php if ($website->casino_logo_2_status == 1) { ?>
				<button class="nav-link p-2" id="v-pills-live-tab" data-bs-toggle="pill" data-bs-target="#v-pills-live" type="button" role="tab" aria-controls="v-pills-live" aria-selected="false">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_2_name ? $website->casino_logo_2_name : 'Live' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_2) ?>" />
				</button>
			<?php } ?>
			<?php if ($website->casino_logo_3_status == 1) { ?>
				<button class="nav-link p-2" id="v-pills-table-tab" data-bs-toggle="pill" data-bs-target="#v-pills-table" type="button" role="tab" aria-controls="v-pills-table" aria-selected="false">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_3_name ? $website->casino_logo_3_name : 'Tables' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_3) ?>" />
				</button>
			<?php } ?>
			<?php if ($website->casino_logo_4_status == 1) { ?>
				<button class="nav-link p-2" id="v-pills-slot-tab" data-bs-toggle="pill" data-bs-target="#v-pills-slot" type="button" role="tab" aria-controls="v-pills-slot" aria-selected="false">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_4_name ? $website->casino_logo_4_name : 'Slot' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_4) ?>" />
				</button>
			<?php } ?>
			<?php if ($website->casino_logo_5_status == 1) { ?>
				<button class="nav-link p-2" id="v-pills-fishing-tab" data-bs-toggle="pill" data-bs-target="#v-pills-fishing" type="button" role="tab" aria-controls="v-pills-fishing" aria-selected="false">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_5_name ? $website->casino_logo_5_name : 'Fishing' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_5) ?>" />
				</button>
			<?php } ?>
			<?php if ($website->casino_logo_6_status == 1) { ?>
				<button class="nav-link p-2" id="v-pills-egame-tab" data-bs-toggle="pill" data-bs-target="#v-pills-egame" type="button" role="tab" aria-controls="v-pills-egame" aria-selected="false">
					<p class="color-gold"><?= isset($website) && $website->casino_logo_6_name ? $website->casino_logo_6_name : 'Egame' ?></p>
					<img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/casino/' . $website->casino_logo_6) ?>" />
				</button>
			<?php } ?>
		</div>
		<div class="tab-content2 w-100 ms-0" id="v-pills-tabContent">
			<!-- sub tabs content in-play  -->
			<div class="tab-pane fade show active" id="v-pills-popular" role="tabpanel" aria-labelledby="v-pills-popular-tab" style="background:var(--nav-text)">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/popular_tabs_content') ?>
			</div>
			<!-- sub tabs content Today  -->
			<div class="tab-pane fade" id="v-pills-live" role="tabpanel" aria-labelledby="v-pills-live-tab">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/live_tabs_content') ?>
			</div>
			<!-- sub tabs content Tomorrow  -->
			<div class="tab-pane fade bg-dark" id="v-pills-table" role="tabpanel" aria-labelledby="v-pills-table-tab">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/table_tabs_content') ?>
			</div>
			<div class="tab-pane fade" id="v-pills-slot" role="tabpanel" aria-labelledby="v-pills-slot-tab">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/sold_tabs_content') ?>
			</div>
			<div class="tab-pane fade" id="v-pills-fishing" role="tabpanel" aria-labelledby="v-pills-fishing-tab">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/fishing_tabs_content') ?>
			</div>
			<div class="tab-pane fade" id="v-pills-egame" role="tabpanel" aria-labelledby="v-pills-egame-tab">
				<?php $this->load->view('website/' . $this->theme . '/pages/casino/egame_tabs_content') ?>
			</div>
		</div>

	</div>
	<?php $this->load->view('website/' . $this->theme . '/offcanvas/search_canvas') ?>