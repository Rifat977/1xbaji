<div id="fishing" class="align-items-start">
	<div class="nav nav-pills p-2 sub-perent" id="spade3-pills-tab" role="tablist" aria-orientation="vertical">
		<button class="nav-link active" id="spade3-pills-latest13-tab" data-bs-toggle="pill" data-bs-target="#spade3-pills-latest13" type="button" role="tab" aria-controls="spade3-pills-latest13" aria-selected="true">
			<p class="m-0">SPADE</p>
		</button>
		<button class="nav-link" id="spade3-pills-AtoZs13-tab" data-bs-toggle="pill" data-bs-target="#spade3-pills-AtoZs13" type="button" role="tab" aria-controls="spade3-pills-AtoZs13" aria-selected="false">
			<p class="m-0">JILI</p>
		</button>
	</div>
	<div class="tab-content2 w-100" id="spade3-pills-tabContent">
		<!-- sub tabs content in-play  -->
		<div class="tab-pane fade show active" id="spade3-pills-latest13" role="tabpanel" aria-labelledby="spade3-pills-latest13-tab">
			<div id="spade4" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="spade4-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="spade4-pills-latest14-tab" data-bs-toggle="pill" data-bs-target="#spade4-pills-latest14" type="button" role="tab" aria-controls="spade4-pills-latest14" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="spade4-pills-AtoZs14-tab" data-bs-toggle="pill" data-bs-target="#spade4-pills-AtoZs14" type="button" role="tab" aria-controls="spade4-pills-AtoZs14" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="spade4-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="spade4-pills-latest14" role="tabpanel" aria-labelledby="spade4-pills-latest14-tab">
							<div id="latest14" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 7, 'sub2' => 13, 'sub_category_item' => 'Latest'])->result();
									foreach ($popular_catalog as $k => $v) { ?>
										<div class="col-4 pm">
											<a href="#" onclick="go_casino('<?= $v->casino_item_url ?>')">
												<div class="border-leftbn-rightop" style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/casino-item/' . $v->image) ?>'); background-size: cover;height:130px"></div>
											</a>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="spade4-pills-AtoZs14" role="tabpanel" aria-labelledby="spade4-pills-AtoZs14-tab">
							<div id="AtoZs14" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 7, 'sub2' => 13, 'sub_category_item' => 'A-Z'])->result();
									foreach ($popular_catalog as $k => $v) { ?>
										<div class="col-4 pm">
											<a href="#" onclick="go_casino('<?= $v->casino_item_url ?>')">
												<div class="border-leftbn-rightop" style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/casino-item/' . $v->image) ?>'); background-size: cover;height:130px"></div>
											</a>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- sub tabs content Today  -->

		<!-- sub tabs content Tomorrow  -->
		<div class="tab-pane fade" id="spade3-pills-AtoZs13" role="tabpanel" aria-labelledby="spade3-pills-AtoZs13-tab">
			<div id="jili4" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="jili4-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="jili4-pills-latest15-tab" data-bs-toggle="pill" data-bs-target="#jili4-pills-latest15" type="button" role="tab" aria-controls="jili4-pills-latest15" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="jili4-pills-AtoZs15-tab" data-bs-toggle="pill" data-bs-target="#jili4-pills-AtoZs15" type="button" role="tab" aria-controls="jili4-pills-AtoZs15" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="jili4-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="jili4-pills-latest15" role="tabpanel" aria-labelledby="jili4-pills-latest15-tab">
							<div id="latest15" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 7, 'sub2' => 14, 'sub_category_item' => 'Latest'])->result();
									foreach ($popular_catalog as $k => $v) { ?>
										<div class="col-4 pm">
											<a href="#" onclick="go_casino('<?= $v->casino_item_url ?>')">
												<div class="border-leftbn-rightop" style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/casino-item/' . $v->image) ?>'); background-size: cover;height:130px"></div>
											</a>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="jili4-pills-AtoZs15" role="tabpanel" aria-labelledby="jili4-pills-AtoZs15-tab">
							<div id="AtoZs15" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 7, 'sub2' => 14, 'sub_category_item' => 'A-Z'])->result();
									foreach ($popular_catalog as $k => $v) { ?>
										<div class="col-4 pm">
											<a href="#" onclick="go_casino('<?= $v->casino_item_url ?>')">
												<div class="border-leftbn-rightop" style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/casino-item/' . $v->image) ?>'); background-size: cover;height:130px"></div>
											</a>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>