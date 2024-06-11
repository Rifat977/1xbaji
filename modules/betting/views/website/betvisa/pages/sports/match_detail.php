<div class="container mt-5">
	<!-- <div class="rounded-5 w-100 overflow-auto opacity-25">
		<table class="table text-nowrap border-bottom-none">
			<thead class="bg-warning rounded-top rounded-3">
				<tr>
					<th colspan="2"><i class="fa-regular fa-star"></i> Match Odds</th>
					<td>| Back</td>
					<td>Lay</td>
				</tr>
			</thead>
			<tbody>
				<tr class="text-center">
					<th colspan="2" class="text-start">Birmingham Phoenix</th>
					<td>
						<div class=" rounded-3 bg-info p-2">
							<h5 class="mb-0">3.4</h5>
							<p class="mb-0">3,234.00</p>
						</div>
					</td>
					<td>
						<div class=" rounded-3 bg-secondary p-2">
							<h5 class="mb-0">3.4</h5>
							<p class="mb-0">3,234.00</p>
						</div>
					</td>
				</tr>
				<tr class="text-center">
					<th colspan="2" class="text-start">London Spirit</th>
					<td>
						<div class=" rounded-3 bg-info p-2">
							<h5 class="mb-0">3.4</h5>
							<p class="mb-0">3,234.00</p>
						</div>
					</td>
					<td>
						<div class=" rounded-3 bg-secondary p-2">
							<h5 class="mb-0">3.4</h5>
							<p class="mb-0">3,234.00</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div> -->
	<h3 class="text-center match_name"><?= isset($_GET['match_title']) ? $_GET['match_title'] : '' ?></h3>
	<div class="card">
		<div class="card-header bg-dark text-white pb-0">
			<button class="btn bg-warning fs-5 rounded-0">Sportsbook</button>
		</div>
		<div class="card-body">
			<!-- <div class="row">
				<div class="col-10 p-0">
					<ul class="nav nav-tabs flex-nowrap hscroll" id="match_detail_tab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="home" aria-selected="true">All</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#popular" type="button" role="tab" aria-controls="profile" aria-selected="false">Popular</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#match" type="button" role="tab" aria-controls="contact" aria-selected="false">Match</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#over" type="button" role="tab" aria-controls="contact" aria-selected="false">Over</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#innings" type="button" role="tab" aria-controls="contact" aria-selected="false">Innings</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#players" type="button" role="tab" aria-controls="contact" aria-selected="false">Players</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#headtohead" type="button" role="tab" aria-controls="contact" aria-selected="false">HeadToHead</button>
						</li>
					</ul>
				</div>
				<div class="col-2">
					<span class="btn btn-warning" data-bs-toggle="offcanvas" data-bs-target="#download_pdf"><i class="fa-solid fa-info-circle"></i></span>
				</div>
			</div> -->

			<div class="tab-content match_details_div" id="match_detail_tabContent">
				<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">

				</div>
				<div class="tab-pane fade" id="popular" role="tabpanel" aria-labelledby="profile-tab">

				</div>
				<div class="tab-pane fade" id="match" role="tabpanel" aria-labelledby="contact-tab">

				</div>
				<div class="tab-pane fade" id="over" role="tabpanel" aria-labelledby="contact-tab">

				</div>
				<div class="tab-pane fade" id="innings" role="tabpanel" aria-labelledby="contact-tab">

				</div>
				<div class="tab-pane fade" id="players" role="tabpanel" aria-labelledby="contact-tab">

				</div>
				<div class="tab-pane fade" id="headtohead" role="tabpanel" aria-labelledby="contact-tab">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="liveToastBtn" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header bg-dark text-white">
		<h6 class="offcanvas-title text-center fw-bold" id="offcanvasBottomLabel">Rules of Sportbook</h6>
		<button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-close text-white"></i></button>
	</div>
	<div class="offcanvas-body small">
		<div class="container">
			<div class="download_item">
				<i class="fa-regular fa-file-pdf me-2 fs-5"></i> <span class="fs-5">Cricket Inplay</span> <button class="btn btn-warning float-end"><i class="fa-solid fa-download"></i></button>
			</div>
			<div class="download_item">
				<i class="fa-regular fa-file-pdf me-2 fs-5"></i> <span class="fs-5">Cricket PreMatch</span> <button class="btn btn-warning float-end"><i class="fa-solid fa-download"></i></button>
			</div>
		</div>
	</div>
</div>



<?php $this->load->view('website/' . $this->theme . '/offcanvas/set_bet') ?>


<script>
	$('.view_single').on('click', function() {
		var i = $(this).children()[1];
		var node = $(this).children()[1].classList;
		console.log(node[1]);
		$(i).toggleClass('fa-chevron-up');
		$(i).toggleClass('fa-chevron-down');
	});

	$(document).ready(function() {
		match_detail();
	});

	function set_bet(name, point, sport_id, sport_key, bet_key, bet_type, team) {

		var session = "<?= !empty($_SESSION['logged_in']) ? $_SESSION['logged_in']->id : '' ?>";
		if (session == '') {
			window.location.href = '<?= base_url('betting/login') ?>';
		} else {
			$('#set_bet_title').html(name);
			$('.get_point').val(point);
			$('#set_bet').offcanvas('show');
			$('.stake_input').val('0').keyup();
			$('#sport_key').val(sport_key);
			$('#sport_id').val(sport_id);
			$('.bet_total').html(0);
			$('#bet_name').val(name);
			$('#bet_key').val(bet_key);
			$('#bet_type').val(bet_type);
			$('#bet_team').val(team);
		}
	}

	function match_detail() {
		var main_id = '<?= $_GET['main_id'] ?>';
		var id = '<?= $_GET['id'] ?>';
		var key = '<?= $_GET['key'] ?>';
		$.ajax({
			type: "post",
			url: "<?= base_url('betting/match_data') ?>",
			data: {
				main_id: main_id,
				id: id,
				key: key,
				'<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
			},
			dataType: "json",
			success: function(data) {
				var history = JSON.parse(data.history);
				var manual = JSON.parse(data.manual);
				var manual_html = '';

				$('#all').empty();
				var team = '';
				if (history != '' && history.output != 'undefined' && history.output != '') {
					var output_data = history.output.data;
					if (output_data != '') {
						$.each(output_data, function(i, v) {
							if (v.id == id) {
								var html = '';
								team = v.home_team + " VS " + v.away_team;
								// main div 
								html += '<div class="mb-2 overflow-auto">';
								$.each(v.bookmakers, function(index, value) {
									html += '<span class="btn w-100 text-start p-3 bg-light rounded-top rounded-5 view_single match_detail mt-2" data-bs-toggle="collapse" data-bs-target="#match_detail' + index + '" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa-regular fa-star"></i> ' + value.title + ' <i class="fa-solid fa-chevron-down float-end"></i></span>';
									html += '<div class="collapse match_details show" id="match_detail' + index + '">';
									$.each(value.markets, function(ind, val) {

										html += '<div class="btn d-flex justify-content-between align-items-center p-0 mb-2">';
										$.each(val.outcomes, function(ii, vv) {
											html += '<div class="first me-2 result" onclick="set_bet(\'' + vv.name + '\', ' + vv.price + ',\'' + v.id + '\', \'' + v.sport_key + '\', \'' + value.key + '\', \'auto\',\'' + team + '\')"><span class="mb-0 name"> ' + vv.name + ' </span><br> <span class="result-point">' + vv.price + '</span></div>';
										});
										html += '</div>';
									});
									html += '</div>';
								});

								// main div end 
								html += '</div>';


								$('#all').append(html);
							}
						});
					}
				}

				// Manual Bets 
				if (manual != '') {
					$.each(manual, function(i, v) {
						if (v.id == id) {
							var html = '';
							// main div 
							html += '<div class="mb-2 overflow-auto">';
							$.each(v.bookmakers, function(index, value) {

								html += '<span class="btn w-100 text-start p-3 bg-light rounded-top rounded-5 view_single match_detail" data-bs-toggle="collapse" data-bs-target="#match_detail2' + index + '" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa-regular fa-star"></i> ' + value.title + ' <i class="fa-solid fa-chevron-down float-end"></i></span>';
								html += '<div class="collapse match_details show" id="match_detail2' + index + '">';

								html += '<div class="btn d-flex justify-content-between align-items-center flex-wrap p-0 me-2">';

								$.each(value.markets, function(ind, val) {
									html += '<div class="first result4" onclick="set_bet(\'' + val.name + '\', ' + val.price + ',\'' + v.id + '\', \'' + v.sport_key + '\', \'' + value.title + '\', \'manual\',\'' + team + '\')"><span class="mb-0 name"> ' + val.name + ' </span><br> <span class="result-point">' + val.price + '</span></div>';
								});
								html += '</div>';
								html += '</div>';
							});

							// main div end 
							html += '</div>';


							$('#all').append(html);
						}
					});
				}
			}
		});
	}

	<?php if (strlen(get_option('betting_auto_timer')) > 0 && get_option('betting_auto_timer') > 0) { ?>
		setInterval(match_detail, <?= get_option('betting_auto_timer') ?>);
	<?php } ?>
</script>