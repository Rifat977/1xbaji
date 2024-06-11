<div id="table" class="align-items-start">
	<div class="nav nav-pills p-2 sub-perent" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<button class="nav-link active" id="q-pills-kingmaker-tab" data-bs-toggle="pill" data-bs-target="#q-pills-kingmaker" type="button" role="tab" aria-controls="q-pills-kingmaker" aria-selected="true">
			<p class="m-0">KINGMAKER</p>
		</button>
		<button class="nav-link" id="q-pills-jili-tab" data-bs-toggle="pill" data-bs-target="#q-pills-jili" type="button" role="tab" aria-controls="q-pills-jili" aria-selected="false">
			<p class="m-0">JILI</p>
		</button>
	</div>
	<div class="tab-content2 w-100" id="v-pills-tabContent" style="background:var(--body)">
		<!-- sub tabs content in-play  -->
		<div class="tab-pane fade show active" id="q-pills-kingmaker" role="tabpanel" aria-labelledby="q-pills-kingmaker-tab">
			<div id="kingmaker" class="align-items-start">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="q-pills-latest3-tab" data-bs-toggle="pill" data-bs-target="#q-pills-latest3" type="button" role="tab" aria-controls="q-pills-latest3" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="q-pills-AtoZ3-tab" data-bs-toggle="pill" data-bs-target="#q-pills-AtoZ3" type="button" role="tab" aria-controls="q-pills-AtoZ3" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="v-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="q-pills-latest3" role="tabpanel" aria-labelledby="q-pills-latest3-tab">
							<div id="latest3" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 3, 'sub2' => 3, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="q-pills-AtoZ3" role="tabpanel" aria-labelledby="q-pills-AtoZ3-tab">
							<div id="AtoZ3" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 3, 'sub2' => 3, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-jili" role="tabpanel" aria-labelledby="q-pills-jili-tab">
			<div id="jili" class="align-items-start">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="q-pills-latest4-tab" data-bs-toggle="pill" data-bs-target="#q-pills-latest4" type="button" role="tab" aria-controls="q-pills-latest4" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="q-pills-AtoZ4-tab" data-bs-toggle="pill" data-bs-target="#q-pills-AtoZ4" type="button" role="tab" aria-controls="q-pills-AtoZ4" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="v-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="q-pills-latest4" role="tabpanel" aria-labelledby="q-pills-latest4-tab">
							<div class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 3, 'sub2' => 4, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="q-pills-AtoZ4" role="tabpanel" aria-labelledby="q-pills-AtoZ4-tab">
							<div class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 3, 'sub2' => 4, 'sub_category_item' => 'A-Z'])->result();
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