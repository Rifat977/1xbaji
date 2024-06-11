<ul class="nav nav-pills mb-3 p-3 bg-dark" id="league_tab_sports" role="tablist">
	<li class="nav-item" role="presentation">
		<button class="nav-link active rounded-pill" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#league_tab_sports_cricket" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-basketball"></i> Cricket</button>
	</li>
	<li class="nav-item" role="presentation">
		<button class="nav-link rounded-pill" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#league_tab_sports_football" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-regular fa-futbol"></i> Football</button>
	</li>
	<li class="nav-item" role="presentation">
		<button class="nav-link rounded-pill" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#league_tab_sports_tennis" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa-solid fa-baseball"></i> Tennis</button>
	</li>
</ul>
<div class="p-3 leagues">
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active cricket_div" id="league_tab_sports_cricket" role="tabpanel" aria-labelledby="pills-home-tab">
			<h5 class="leagues_heading">Popular</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_  = ['International Twenty20 Matches', 'One Day Internationals', 'Caribbean Premier League', 'The Hundred', 'T20 International SRL'];
					foreach ($cricket_ as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>

				</div>
			</div>

			<h5 class="leagues_heading">Rest Of The World</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_rest  = ['Asia Cup', 'CDU Strike League 20 over series', 'ICC Cricket World Cup', 'Indian Premier League', 'Metro Bank One Day Cup', 'T20 Sher E Punjab Cup'];
					foreach ($cricket_rest as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="league_tab_sports_football" role="tabpanel" aria-labelledby="pills-profile-tab">
			<h5 class="leagues_heading">Popular</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_  = ['International Twenty20 Matches', 'One Day Internationals', 'Caribbean Premier League', 'The Hundred', 'T20 International SRL'];
					foreach ($cricket_ as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>

				</div>
			</div>

			<h5 class="leagues_heading">Rest Of The World</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_rest  = ['Asia Cup', 'CDU Strike League 20 over series', 'ICC Cricket World Cup', 'Indian Premier League', 'Metro Bank One Day Cup', 'T20 Sher E Punjab Cup'];
					foreach ($cricket_rest as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>

				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="league_tab_sports_tennis" role="tabpanel" aria-labelledby="pills-contact-tab">
			<h5 class="leagues_heading">Popular</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_  = ['International Twenty20 Matches', 'One Day Internationals', 'Caribbean Premier League', 'The Hundred', 'T20 International SRL'];
					foreach ($cricket_ as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>

				</div>
			</div>

			<h5 class="leagues_heading">Rest Of The World</h5>
			<div class="card">
				<div class="card-body p-0">
					<?php
					$cricket_rest  = ['Asia Cup', 'CDU Strike League 20 over series', 'ICC Cricket World Cup', 'Indian Premier League', 'Metro Bank One Day Cup', 'T20 Sher E Punjab Cup'];
					foreach ($cricket_rest as $key => $value) { ?>
						<a href="#" class="link_title" onclick="league_match('<?= $value ?>')">
							<div>
								<i class="fa-solid fa-circle-arrow-up me-2"></i><?= $value ?>
							</div>
							<div>
								<span> <i class="fa-solid fa-chevron-right"></i></span>
							</div>
						</a>
						<hr>
					<?php }
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="leagues_list_canvas" aria-labelledby="offcanvasBottomLabel">
	<div class="bg-dark offcanvas-header">
		<h5 class="text-white">
			<i class="fa-solid fa-chevron-left me-3" data-bs-dismiss="offcanvas"></i>
			<span id="leagues_list_canvas_label">Asia Cup</span>
		</h5>
	</div>
	<div class="offcanvas-body small">
		<div class="container">
			<div class="card">
				<div class="card-body p-0 match_list">
					<!-- <a href="#" class="link_title">
						<div>
							<span class="t_time">Aug 12:40</span><br>
							<?= $value ?>
						</div>
						<div>
							<span> <i class="fa-solid fa-chevron-right"></i></span>
						</div>
					</a>
					<hr> -->
				</div>
			</div>
		</div>

	</div>
</div>


<script>
	function league_match(heading) {
		window.location.href = '<?= base_url('betting/league_match?type=league') ?>'
		// $('.match_list').empty();
		// $('#leagues_list_canvas').offcanvas('show');
		// $('#leagues_list_canvas_label').text(heading);

		// // Adding chlid 
		// for (let i = 0; i < 3; i++) {
		// 	$('.match_list').append('<a href="<?= base_url('betting/match_detail') ?>" class="link_title"><div><span class="t_time"> Aug 12: 40 </span><br> ODI Match</div><div><span> <i class="fa-solid fa-chevron-right"> </i></span></div></a><hr>');
		// }
	}
</script>