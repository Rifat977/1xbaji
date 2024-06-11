<div id="popular" class="align-items-start background">
	<div class="d-flex justify-content-between">
		<div class="nav nav-pills p-2 child-perent" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<button class="nav-link active" id="q-pills-popular-tab" data-bs-toggle="pill" data-bs-target="#q-pills-popular" type="button" role="tab" aria-controls="q-pills-popular" aria-selected="true">
				<p class="m-0">Catalog</p>
			</button>
			<button class="nav-link" id="q-pills-latest-tab" data-bs-toggle="pill" data-bs-target="#q-pills-latest" type="button" role="tab" aria-controls="q-pills-latest" aria-selected="false">
				<p class="m-0">Latest</p>
			</button>
			<button class="nav-link" id="q-pills-table-tab" data-bs-toggle="pill" data-bs-target="#q-pills-table" type="button" role="tab" aria-controls="q-pills-table" aria-selected="false">
				<p class="m-0">A-Z</p>
			</button>
		</div>
		<div class="me-3">
			<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
		</div>
	</div>

	<div class="tab-content2 w-100" id="v-pills-tabContent">
		<div class="tab-pane fade show active border-radius-5" id="q-pills-popular" role="tabpanel" aria-labelledby="q-pills-popular-tab">
			<section class="p-2 bg-light border-radius-5">
				<span class="text-dark bg-warning px-5 py-1 fw-bold border-radius-5">Game Shows</span>
				<div class="container ful-content mt-2">
					<div class="row">
						<?php
						$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 1, 'sub_category_item' => 'Catalog'])->result();
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
			</section>
		</div>
		<div class="tab-pane fade border-radius-5" id="q-pills-latest" role="tabpanel" aria-labelledby="q-pills-latest-tab">
			<div class="container ful-content mt-2">
				<div class="row">
					<?php
					$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 1, 'sub_category_item' => 'Latest'])->result();
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
		<div class="tab-pane fade border-radius-5" id="q-pills-table" role="tabpanel" aria-labelledby="q-pills-table-tab">
			<section class="p-2 bg-light border-radius-5">
				<span class="text-dark bg-warning px-5 py-1 fw-bold border-radius-5">A</span>
				<div class="container ful-content mt-2">
					<div class="row">
						<?php
						$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 1, 'sub_category_item' => 'A-Z'])->result();
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
			</section>
		</div>
	</div>


</div>