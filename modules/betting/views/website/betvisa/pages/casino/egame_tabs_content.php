	<div id="egame2" class="align-items-start">
		<div class="nav nav-pills p-2 sub-perent" id="egame2-pills-tab" role="tablist" aria-orientation="vertical">
			<button class="nav-link active" id="egame2-pills-pp2-tab" data-bs-toggle="pill" data-bs-target="#egame2-pills-pp2" type="button" role="tab" aria-controls="egame2-pills-pp2" aria-selected="true">
				<p class="m-0">PP</p>
			</button>
			<button class="nav-link" id="egame2-pills-jdb2-tab" data-bs-toggle="pill" data-bs-target="#egame2-pills-jdb2" type="button" role="tab" aria-controls="egame2-pills-jili2" aria-selected="false">
				<p class="m-0">JDB</p>
			</button>
		</div>
		<div class="tab-content2 w-100" id="egame2-pills-tabContent">
			<!-- sub tabs content in-play  -->
			<div class="tab-pane fade show active background" id="egame2-pills-pp2" role="tabpanel" aria-labelledby="egame2-pills-pp2-tab">
				<div id="pps3" class="align-items-start background">
					<div class="d-flex justify-content-between">
						<div class="nav nav-pills p-2 child-perent" id="pps3-pills-tab" role="tablist" aria-orientation="vertical">
							<button class="nav-link active" id="pps3-pills-latest16-tab" data-bs-toggle="pill" data-bs-target="#pps3-pills-latest16" type="button" role="tab" aria-controls="pps3-pills-latest16" aria-selected="true">
								<p class="m-0">Latest</p>
							</button>
							<button class="nav-link" id="pps3-pills-AtoZs16-tab" data-bs-toggle="pill" data-bs-target="#pps3-pills-AtoZs16" type="button" role="tab" aria-controls="pps3-pills-AtoZs16" aria-selected="false">
								<p class="m-0">A-Z</p>
							</button>
						</div>
						<div class="me-3">
							<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div>
					</div>
					<div class="tab-content21 w-100 " id="pps3-pills-tabContent">
						<div class="container">
							<div class="tab-pane fade show active border-radius-5" id="pps3-pills-latest16" role="tabpanel" aria-labelledby="pps3-pills-latest16-tab">
								<div id="latest16" class="container-fuid ful-content mt-2">
									<div class="row">
										<?php
										$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 8, 'sub2' => 15, 'sub_category_item' => 'Latest'])->result();
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
							<div class="tab-pane fade" id="pps3-pills-AtoZs16" role="tabpanel" aria-labelledby="pps3-pills-AtoZs16-tab">
								<div id="AtoZs16" class="container-fuid ful-content mt-2">
									<div class="row">
										<?php
										$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 8, 'sub2' => 15, 'sub_category_item' => 'A-Z'])->result();
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
			<div class="tab-pane fade" id="egame2-pills-jdb2" role="tabpanel" aria-labelledby="egame2-pills-jdb2-tab">
				<div id="jdb3" class="align-items-start background">
					<div class="d-flex justify-content-between">
						<div class="nav nav-pills p-2 child-perent" id="jdb3-pills-tab" role="tablist" aria-orientation="vertical">
							<button class="nav-link active" id="jdb3-pills-latest17-tab" data-bs-toggle="pill" data-bs-target="#jdb3-pills-latest17" type="button" role="tab" aria-controls="jdb3-pills-latest17" aria-selected="true">
								<p class="m-0">Latest</p>
							</button>
							<button class="nav-link" id="jdb3-pills-AtoZs17-tab" data-bs-toggle="pill" data-bs-target="#jdb3-pills-AtoZs17" type="button" role="tab" aria-controls="jdb3-pills-AtoZs17" aria-selected="false">
								<p class="m-0">A-Z</p>
							</button>
						</div>
						<div class="me-3">
							<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div>
					</div>
					<div class="tab-content21 w-100" id="jdb3-pills-tabContent">
						<div class="container">
							<div class="tab-pane fade show active" id="jdb3-pills-latest17" role="tabpanel" aria-labelledby="jdb3-pills-latest17-tab">
								<div id="latest17" class="container-fuid ful-content mt-2">
									<div class="row">
										<?php
										$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 8, 'sub2' => 16, 'sub_category_item' => 'Latest'])->result();
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
							<div class="tab-pane fade" id="jdb3-pills-AtoZs17" role="tabpanel" aria-labelledby="jdb3-pills-AtoZs17-tab">
								<div id="AtoZs17" class="container-fuid ful-content mt-2">
									<div class="row">
										<?php
										$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 8, 'sub2' => 16, 'sub_category_item' => 'A-Z'])->result();
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