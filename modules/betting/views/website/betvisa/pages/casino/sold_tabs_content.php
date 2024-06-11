<div id="sold" class="align-items-start">
	<div class="nav nav-pills p-2 sub-perent" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<button class="nav-link active" id="q-pills-pp-tab" data-bs-toggle="pill" data-bs-target="#q-pills-pp" type="button" role="tab" aria-controls="q-pills-pp" aria-selected="true">
			<p class="m-0">PP</p>
		</button>
		<button class="nav-link" id="q-pills-kingmaker2-tab" data-bs-toggle="pill" data-bs-target="#q-pills-kingmaker2" type="button" role="tab" aria-controls="q-pills-kingmaker2" aria-selected="false">
			<p class="m-0">KINGMAKER</p>
		</button>
		<button class="nav-link" id="q-pills-dragoonsoft-tab" data-bs-toggle="pill" data-bs-target="#q-pills-dragoonsoft" type="button" role="tab" aria-controls="q-pills-dragoonsoft" aria-selected="false">
			<p class="m-0">DRAGOONSOFT</p>
		</button>
		<button class="nav-link" id="q-pills-spade-tab" data-bs-toggle="pill" data-bs-target="#q-pills-spade" type="button" role="tab" aria-controls="q-pills-spade" aria-selected="false">
			<p class="m-0">SPADE</p>
		</button>
		<button class="nav-link" id="q-pills-pt-tab" data-bs-toggle="pill" data-bs-target="#q-pills-pt" type="button" role="tab" aria-controls="q-pills-pt" aria-selected="false">
			<p class="m-0">PT</p>
		</button>
		<button class="nav-link" id="q-pills-jdb-tab" data-bs-toggle="pill" data-bs-target="#q-pills-jdb" type="button" role="tab" aria-controls="q-pills-jdb" aria-selected="false">
			<p class="m-0">JDB</p>
		</button>
		<button class="nav-link" id="q-pills-fc-tab" data-bs-toggle="pill" data-bs-target="#q-pills-fc" type="button" role="tab" aria-controls="q-pills-fc" aria-selected="false">
			<p class="m-0">FC</p>
		</button>
		<button class="nav-link" id="q-pills-jili2-tab" data-bs-toggle="pill" data-bs-target="#q-pills-jili2" type="button" role="tab" aria-controls="q-pills-jili2" aria-selected="false">
			<p class="m-0">JILI</p>
		</button>
	</div>
	<div class="tab-content2 w-100" id="v-pills-tabContent">
		<!-- sub tabs content in-play  -->
		<div class="tab-pane fade show active" id="q-pills-pp" role="tabpanel" aria-labelledby="q-pills-pp-tab">
			<div id="ppp" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="w-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="w-pills-latest5-tab" data-bs-toggle="pill" data-bs-target="#w-pills-latest5" type="button" role="tab" aria-controls="w-pills-latest5" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="w-pills-AtoZs5-tab" data-bs-toggle="pill" data-bs-target="#w-pills-AtoZs5" type="button" role="tab" aria-controls="w-pills-AtoZs5" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="w-pills-tabContent" style="background:var(--white)">
					<div class="container">
						<div class="tab-pane fade show active" id="w-pills-latest5" role="tabpanel" aria-labelledby="w-pills-latest5-tab">
							<div id="latest5" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 5, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="w-pills-AtoZs5" role="tabpanel" aria-labelledby="w-pills-AtoZs5-tab">
							<div id="" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 5, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-kingmaker2" role="tabpanel" aria-labelledby="q-pills-kingmaker2-tab">
			<div id="kingmaker" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="w-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="w-pills-latest6-tab" data-bs-toggle="pill" data-bs-target="#w-pills-latest6" type="button" role="tab" aria-controls="w-pills-latest6" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="w-pills-AtoZs6-tab" data-bs-toggle="pill" data-bs-target="#w-pills-AtoZs6" type="button" role="tab" aria-controls="w-pills-AtoZs6" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="w-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="w-pills-latest6" role="tabpanel" aria-labelledby="w-pills-latest6-tab">
							<div id="latest5" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 6, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="w-pills-AtoZs6" role="tabpanel" aria-labelledby="w-pills-AtoZs6-tab">
							<div id="" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 6, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-dragoonsoft" role="tabpanel" aria-labelledby="q-pills-dragoonsoft-tab">
			<div id="dragoonsofts" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="z-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="z-pills-latest7-tab" data-bs-toggle="pill" data-bs-target="#z-pills-latest7" type="button" role="tab" aria-controls="z-pills-latest7" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="z-pills-AtoZs7-tab" data-bs-toggle="pill" data-bs-target="#z-pills-AtoZs7" type="button" role="tab" aria-controls="z-pills-AtoZs7" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="z-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="z-pills-latest7" role="tabpanel" aria-labelledby="z-pills-latest7-tab">
							<div id="latest7" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 7, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="z-pills-AtoZs7" role="tabpanel" aria-labelledby="z-pills-AtoZs7-tab">
							<div id="AtoZs7" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 7, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-spade" role="tabpanel" aria-labelledby="q-pills-spade-tab">
			<div id="spades" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="y-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="y-pills-latest8-tab" data-bs-toggle="pill" data-bs-target="#y-pills-latest8" type="button" role="tab" aria-controls="y-pills-latest8" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="y-pills-AtoZs8-tab" data-bs-toggle="pill" data-bs-target="#y-pills-AtoZs8" type="button" role="tab" aria-controls="y-pills-AtoZs8" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="y-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="y-pills-latest8" role="tabpanel" aria-labelledby="y-pills-latest8-tab">
							<div id="latest8" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 8, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="y-pills-AtoZs8" role="tabpanel" aria-labelledby="y-pills-AtoZs8-tab">
							<div id="AtoZs8" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 8, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-pt" role="tabpanel" aria-labelledby="q-pills-pt-tab">
			<div id="spades" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="x-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="x-pills-latest9-tab" data-bs-toggle="pill" data-bs-target="#x-pills-latest9" type="button" role="tab" aria-controls="x-pills-latest9" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="x-pills-AtoZs9-tab" data-bs-toggle="pill" data-bs-target="#x-pills-AtoZs9" type="button" role="tab" aria-controls="x-pills-AtoZs9" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="x-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="x-pills-latest9" role="tabpanel" aria-labelledby="x-pills-latest9-tab">
							<div id="latest8" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 9, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="x-pills-AtoZs9" role="tabpanel" aria-labelledby="x-pills-AtoZs9-tab">
							<div id="AtoZs8" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 9, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-jdb" role="tabpanel" aria-labelledby="q-pills-pt-jdb">
			<div id="spades" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="nx-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="nx-pills-latest10-tab" data-bs-toggle="pill" data-bs-target="#nx-pills-latest10" type="button" role="tab" aria-controls="nx-pills-latest10" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="nx-pills-AtoZs10-tab" data-bs-toggle="pill" data-bs-target="#nx-pills-AtoZs10" type="button" role="tab" aria-controls="nx-pills-AtoZs10" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="nx-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="nx-pills-latest10" role="tabpanel" aria-labelledby="nx-pills-latest10-tab">
							<div id="latest10" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 10, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="nx-pills-AtoZs10" role="tabpanel" aria-labelledby="nx-pills-AtoZs10-tab">
							<div id="AtoZs10" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 10, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-fc" role="tabpanel" aria-labelledby="q-pills-pt-fc">
			<div id="spades" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="fc-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="fc-pills-latest11-tab" data-bs-toggle="pill" data-bs-target="#fc-pills-latest11" type="button" role="tab" aria-controls="fc-pills-latest11" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="fc-pills-AtoZs11-tab" data-bs-toggle="pill" data-bs-target="#fc-pills-AtoZs11" type="button" role="tab" aria-controls="fc-pills-AtoZs11" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="fc-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="fc-pills-latest11" role="tabpanel" aria-labelledby="fc-pills-latest11-tab">
							<div id="latest11" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 11, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="fc-pills-AtoZs11" role="tabpanel" aria-labelledby="fc-pills-AtoZs11-tab">
							<div id="AtoZs11" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 11, 'sub_category_item' => 'A-Z'])->result();
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
		<div class="tab-pane fade" id="q-pills-jili2" role="tabpanel" aria-labelledby="q-pills-pt-jili2">
			<div id="spades" class="align-items-start background">
				<div class="d-flex justify-content-between">
					<div class="nav nav-pills p-2 child-perent" id="jili-pills-tab" role="tablist" aria-orientation="vertical">
						<button class="nav-link active" id="jili-pills-latest12-tab" data-bs-toggle="pill" data-bs-target="#jili-pills-latest12" type="button" role="tab" aria-controls="jili-pills-latest12" aria-selected="true">
							<p class="m-0">Latest</p>
						</button>
						<button class="nav-link" id="jili-pills-AtoZs12-tab" data-bs-toggle="pill" data-bs-target="#jili-pills-AtoZs12" type="button" role="tab" aria-controls="jili-pills-AtoZs12" aria-selected="false">
							<p class="m-0">A-Z</p>
						</button>
					</div>
					<div class="me-3">
						<button class="btn fs-4 float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchBottm" aria-controls="searchBottm"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
				<div class="tab-content21 w-100" id="jili-pills-tabContent">
					<div class="container">
						<div class="tab-pane fade show active" id="jili-pills-latest12" role="tabpanel" aria-labelledby="jili-pills-latest12-tab">
							<div id="latest12" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 12, 'sub_category_item' => 'Latest'])->result();
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
						<div class="tab-pane fade" id="jili-pills-AtoZs12" role="tabpanel" aria-labelledby="jili-pills-AtoZs12-tab">
							<div id="AtoZs12" class="container-fuid ful-content mt-2">
								<div class="row">
									<?php
									$popular_catalog = $this->db->get_where($casino_table, ['category_id' => 4, 'sub2' => 12, 'sub_category_item' => 'Latest'])->result();
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