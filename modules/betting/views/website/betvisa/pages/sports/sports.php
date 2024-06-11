<?php $website =  $this->db->get_where(db_prefix() . 'website')->row();



?>

<div class="align-items-start">
	<!-- marquee -->
	<?php
	if (isset($website) && $website->marquee != '') { ?>
		<div class="d-flex bg-white p-1">
			<div class="px-3 w-65 fs-20">
				<i class="fa-solid fa-microphone"></i>
			</div>
			<div style="border-left: 3px solid var(--yellow);">
				<marquee>
					<ul id="marquee" class="d-flex align-content-center pt-1" behavior="scroll" direction="up" scrolldelay="500">
						<?= $website->marquee; ?>
					</ul>
				</marquee>
			</div>
		</div>
	<?php } ?>
	<div class="header_tabs d-flex flex-nowrap">
		<div class="header_tabs_inner2">
			<div class="sports_header_tabs custom-tabs-ul overflow-auto d-flex flex-nowrap justify-content-evenly">
				<span id="sport_header_all_sports " dc="all_sports" class="custom-li all">
					All
				</span>
				<span id="sport_header_inplay" dc="inplay" class="custom-li inplay">
					In-Play
				</span>
				<span id="sport_header_today" dc='today' class="custom-li today">
					Today
				</span>
				<span id="sport_header_tomorrow" dc="tomorrow" class="custom-li tomorrow">
					Tomorrow
				</span>
				<!-- <span>
					<i class="fa-solid fa-star"></i>
				</span> -->
				<span>
					<i class="fa-solid fa-search" data-bs-toggle="offcanvas" data-bs-target="#seachCanvas" aria-controls="offcanvasBottom"></i>
				</span>

			</div>
		</div>
	</div>

	<!-- Search Offcanvas  -->
	<div class="offcanvas offcanvas-bottom" style="height: 90vh;" tabindex="-1" id="seachCanvas" aria-labelledby="offcanvasBottomLabel">
		<div class="offcanvas-header bg-dark">
			<h5 class="offcanvas-title w-100" id="offcanvasBottomLabel"><input type="text" class="form-control bg-dark text-light border-0" placeholder="Search Tems, Competitions and more..."></h5>
			<button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-close"></i></button>
		</div>
		<div class="offcanvas-body small">
			No Result
		</div>
	</div>

	<!-- Main End  ##################################### sub tabs content in-play ############################# -->
	<div class="tab-content" id="sports_tab">

		<!-- ======================= Main tab All Sports ============================  -->
		<div class="tab-pane  sport_header_all_sports fade custom-content show active" id="all" role="tabpanel" style="border:2px sollid red;">
			<ul class="nav nav-pills mb-3 bg-dark p-3 inplay_section" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link rounded-pill active show all_all " data-bs-toggle="pill" data-bs-target="#all_all" type="button" role="tab" aria-controls="pills-home3" aria-selected="true">
						<i class="fa-solid fa-trophy"></i> All
					</button>
				</li>

				<?php
				foreach ($category as $k => $v) {
				?>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill all_<?= $v['id'] ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#all_<?= $v['id'] ?>" type="button" role="tab" aria-controls="pills-profile7" aria-selected="false">

							<?php
							echo '' . $v['name'];
							?>
						</button>
					</li>
				<?php }
				?>
			</ul>
			<div class="container px-4 py-2 inplay_container">
				<div class="tab-pane fade show active" id="all_all" role="tabpanel" aria-labelledby="pills-home-tab">
					<?php
					sports_list('all');
					?>

				</div>
				<?php
				foreach ($category as $k => $v) { ?>
					<div class="tab-pane fade" id="all_<?= $v['id'] ?>" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class=" mb-4">
							<?php
							sports_list('all', $v['id']);
							?>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>

		<!--====================== Main Tab Inplay ======================== -->
		<div class="tab-pane sports_in_play sport_header_inplay fade custom-content" id="inplay" role="tabpanel">
			<ul class="nav nav-pills mb-3 bg-dark p-3 inplay_section" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link rounded-pill active inplay_all" data-bs-toggle="pill" data-bs-target="#inplay_all" type="button" role="tab" aria-controls="pills-home3" aria-selected="true">
						<i class="fa-solid fa-trophy"></i> All
					</button>
				</li>

				<?php
				foreach ($category as $k => $v) {
				?>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill inplay_<?= $v['id'] ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#inplay_<?= $v['id'] ?>" type="button" role="tab" aria-controls="pills-profile7" aria-selected="false">

							<?php
							echo '' . $v['name'];
							// if ($v['name'] == 'Cricket') {
							// 	echo '<i class="fa-solid fa-basketball"></i> ' . $v['name'];
							// }
							// if ($v['name'] == 'Soccer') {
							// 	echo '<i class="fa-regular fa-futbol"></i> ' . $v['name'];
							// }
							// if ($v['name'] == 'Tennis') {
							// 	echo '<i class="fa-solid fa-baseball"></i> ' . $v['name'];
							// }
							?>
						</button>
					</li>
				<?php }
				?>
			</ul>

			<div class="container px-4 py-2 inplay_container">
				<div class="tab-pane fade show active" id="inplay_all" role="tabpanel" aria-labelledby="pills-home-tab">
					<?php
					sports_list('In-Play');
					?>

				</div>
				<?php
				foreach ($category as $k => $v) { ?>
					<div class="tab-pane fade" id="inplay_<?= $v['id'] ?>" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="cricket_inplay mb-4">
							<?php
							sports_list('In-Play', $v['id']);
							?>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>


		<!-- ======================= Main tab  Today ============================  -->
		<div class="tab-pane fade sport_header_today custom-content" id="today" role="tabpanel">
			<ul class="nav nav-pills mb-3 bg-dark p-3 inplay_section" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active rounded-pill today_all" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#today_all" type="button" role="tab" aria-controls="pills-home2" aria-selected="true">
						<i class="fa-solid fa-trophy"></i> All
					</button>
				</li>
				<?php
				foreach ($category as $k => $v) { ?>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill today_<?= $v['id'] ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#today_<?= $v['id'] ?>" type="button" role="tab" aria-controls="pills-profile7" aria-selected="false">
							<?php
							echo  $v['name'];
							?>
						</button>
					</li>
				<?php }
				?>
			</ul>

			<div class="container px-4 py-2 inplay_container">
				<div class="tab-pane fade show active" id="today_all" role="tabpanel" aria-labelledby="pills-home-tab">
					<div class="cricket_inplay mb-4">
						<?php
						sports_list('Today');
						?>
					</div>
				</div>
				<?php
				foreach ($category as $k => $v) {  ?>
					<div class="tab-pane fade" id="today_<?= $v['id'] ?>" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="cricket_inplay mb-4">
							<?php sports_list('Today', $v['id']) ?>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>



		<!--======================== Main tab  Tomorrow  ====================-->
		<div class="tab-pane fade sport_header_tomorrow custom-content" id="tomorrow" role="tabpanel">
			<ul class="nav nav-pills mb-3 bg-dark p-3 inplay_section" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active rounded-pill tomorrow_all" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#tomorrow_all" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
						<i class="fa-solid fa-trophy"></i> All
					</button>
				</li>
				<?php
				foreach ($category as $k => $v) { ?>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill tomorrow_<?= $v['id'] ?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#tomorrow_<?= $v['id'] ?>" type="button" role="tab" aria-controls="pills-profile7" aria-selected="false">

							<?php
							echo $v['name'];
							?>
						</button>
					</li>
				<?php }
				?>
			</ul>
			<div class="container px-4 py-2 inplay_container">
				<!-- ############## All Sports start ################# -->
				<div class="tab-pane fade show active " id="tomorrow_all" role="tabpanel" aria-labelledby="pills-home-tab">
					<?php sports_list('Tomorrow') ?>
				</div>
				<!-- ############## All Sports end ################# -->

				<?php foreach ($category as $k => $v) {  ?>

					<div class="tab-pane fade" id="tomorrow_<?= $v['id'] ?>" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="cricket_inplay mb-4">
							<?php sports_list('Tomorrow', $v['id']) ?>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</div>
	<!-- Main Start ##################################### sub tabs content in-play ############################# -->
</div>



<script>
	function go_casino(url) {
		window.open(url, '_blank');
	}
	$(document).ready(function() {
		$(' .header_tabs_inner1 input[type=checkbox]').change();

		var type = '<?= isset($_GET['type']) ? $_GET['type'] : '' ?>';
		var sub_type = '<?= isset($_GET['sub_type']) ? $_GET['sub_type'] : '' ?>';
		var sub_type1 = sub_type.split('_');

		if (sub_type1 != '') {
			if (sub_type1[1] != 'all') {
				$('.' + sub_type1[0] + '_all').removeClass('active');
				$('#' + sub_type1[0] + '_all').removeClass('show active');
			}

			$('.' + sub_type1[0]).addClass('active');
			$('#' + sub_type1[0]).addClass('active show');

		}
		$('.' + sub_type).addClass('active');
		$('#' + sub_type).addClass('active show');

	});

	$('.custom-li').click(function(e) {
		e.preventDefault();
		$('.custom-tabs-ul .custom-li').removeClass('active');
		var cls = $(this).attr('id');
		$('.custom-content').removeClass('show active');
		$('.' + cls).addClass('show active');
		$(this).addClass('active');
	});

	$('.header_tabs_inner1 input[type=checkbox]').change(function(e) {
		e.preventDefault();
		if ($(this).prop('checked')) {
			$('.flexSwitchCheckChecked').addClass('text-warning');
		} else {
			$('.flexSwitchCheckChecked').removeClass('text-warning');
			$('.flexSwitchCheckChecked').css('color', 'var(--nav-text)');
		}
	});

	$('.view_all').on('click', function() {
		var i = $(this).children()[0];
		$(i).toggleClass('fa-chevron-down');
		$('.cricket_collapse i').toggleClass('fa-chevron-down');
		$(i).toggleClass('fa-chevron-up');
		$('.cricket_collapse i').toggleClass('fa-chevron-up');
	});

	$('.view_single').on('click', function() {
		var i = $(this).children()[1];
		var node = $(this).children()[1].classList;
		$(i).toggleClass('fa-chevron-up');
		$(i).toggleClass('fa-chevron-down');
	});



	// function get_sports() {
	// 	$.ajax({
	// 		type: "post",
	// 		url: "<?= base_url('betting/get_sports') ?>",
	// 		data: {
	// 			'<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
	// 		},
	// 		dataType: "json",
	// 		success: function(data) {
	// 			var inplay = $('#inplay_all');
	// 			var cricket_category = '';
	// 			var soccer_category = '';
	// 			$.each(data, function(i, v) {
	// 				if (data[i].category_name == 'Cricket' && cricket_category == '') {
	// 					cricket_category = data[i].category_name;
	// 					inplay.append('<div class="d-flex justify-content-between mb-3"> <div class="category-heading"><h4>' + v.category_name + '</h4></div><a class="btn btn-light float-end view_all" data-bs-toggle="collapse" data-bs-target="' + v.category_name + '"aria-expanded="true"> All <i class="fa-solid fa-chevron-up"></i></a></div>');
	// 				}
	// 				if (data[i].category_name == 'Soccer' && soccer_category == '') {
	// 					cricket_category = data[i].category_name;
	// 					inplay.append('<div class="d-flex justify-content-between mb-3"> <div class="category-heading"><h4>' + v.category_name + '</h4></div><a class="btn btn-light float-end view_all" data-bs-toggle="collapse" data-bs-target="' + v.category_name + '"aria-expanded="true"> All <i class="fa-solid fa-chevron-up"></i></a></div>');
	// 				}
	// 				console.log(JSON.parse(data[i].json));
	// 				var category_header = '<div class="d-flex justify-content-between mb-3"> <div class="category-heading"><h4>Cricket</h4></div><a class="btn btn-light float-end view_all" data-bs-toggle="collapse" data-bs-target=".cricket"aria-expanded="true"> All <i class="fa-solid fa-chevron-up"></i></a></div>';


	// 				var html = '<div class="mb-2"><button type="button" class="btn w-100 bg-dark text-white text-start p-3 rounded-top rounded-5 view_single cricket_collapse" data-bs-toggle="collapse" data-bs-target="#cricket_2" aria-expanded="false" aria-controls="multiCollapseExample1"><span class="badge bg-warning">2</span> Premier League SRL <i class="fa-solid fa-chevron-up float-end"></i></button><div class="collapse cricket show" id="cricket_2"><div class="card card-body text-dark"><a href="<?= base_url() ?>/betting/match_detail/2?type=sports"><div class="d-flex justify-content-between align-items-center"><div><span class="t_time">Today 12:00</span><div class="mt-2"><h5><i class="fa-regular fa-star"></i> Afghanistan - Pakistan </h5></div></div><div><h3><i class="fa-solid fa-chevron-right"></i></h3></div></div></a></div></div></div>';

	// 			});
	// 		}
	// 	});
	// }


	// $(document).ready(function() {
	// 	get_sports();
	// });
</script>