<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="current_bets" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header bg-dark text-light">
		<h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Current Bets</h5>
		<button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
	</div>
	<div class="offcanvas-body small p-0">
		<div id="menu-tabs-btn" class="align-items-start">
			<div class="nav nav-pills p-3 menu-overflow  d-flex flex-nowrap" id="j-pills-tab" role="tablist" aria-orientation="vertical">
				<button class="nav-link active fs-16 fw-bold p-0 me-4" id="w-pills-exchange1-tab" data-bs-toggle="pill" data-bs-target="#w-pills-exchange1" type="button" role="tab" aria-controls="w-pills-exchange1" aria-selected="true">
					Exchange
				</button>
				<button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-bookmaker1-tab" data-bs-toggle="pill" data-bs-target="#w-pills-bookmaker1" type="button" role="tab" aria-controls="w-pills-bookmaker1" aria-selected="false">
					Bookmaker
				</button>
				<button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-fancybet1-tab" data-bs-toggle="pill" data-bs-target="#w-pills-fancybet1" type="button" role="tab" aria-controls="w-pills-fancybet1" aria-selected="false">
					Fancybet
				</button>
				<button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-sportsbook1-tab" data-bs-toggle="pill" data-bs-target="#w-pills-sportsbook1" type="button" role="tab" aria-controls="w-pills-sportsbook1" aria-selected="false">
					Sportsbook
				</button>
				<button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-parlay1-tab" data-bs-toggle="pill" data-bs-target="#w-pills-parlay1" type="button" role="tab" aria-controls="w-pills-parlay1" aria-selected="false">
					Parlay
				</button>
			</div>

			<div class="tab-content21 w-100" id="j-pills-tabContent">
				<div class="container">
					<section class="p-3 text-warning d-flow-root ">
						<div>
							<select class="w-100 p-2 menu-sect br5">
								<option class="text-light" value="1">Bet Status Matched</option>

							</select>
						</div>
						<div class="d-flex mt-3 float-end">
							<span class="fs-18">Order By</span>
							<div class="fs-14 ms-2">
								<input class="form-check-input fs-16 current_bet_select" name="current_bet_select" type="checkbox" value="" id="betplaced" checked>
								<label class="form-check-label fs-16 ms-1" for="betplaced">
									Bet Placed
								</label>
							</div>
							<div class="fs-14 ms-2">
								<input class="form-check-input fs-16 current_bet_select" name="current_bet_select" type="checkbox" value="" id="market">
								<label class="form-check-label fs-16 ms-1" for="market">
									Market
								</label>
							</div>
						</div>
					</section>
					<div class="tab-pane fade show active" id="w-pills-exchange1" role="tabpanel" aria-labelledby="w-pills-exchange1-tab">

					</div>

					<div class="tab-pane fade" id="w-pills-bookmaker1" role="tabpanel" aria-labelledby="w-pills-bookmaker1-tab">
						>
					</div>
					<div class="tab-pane fade" id="w-pills-fancybet1" role="tabpanel" aria-labelledby="w-pills-fancybet1-tab">

					</div>
					<div class="tab-pane fade" id="w-pills-sportsbook1" role="tabpanel" aria-labelledby="w-pills-sportsbook1-tab">

					</div>
					<div class="tab-pane fade" id="w-pills-parlay1" role="tabpanel" aria-labelledby="w-pills-parlay1-tab">

					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<script>
	$('.current_bet_select').change(function(e) {
		e.preventDefault();
		if ($(this).prop('checked')) {
			$('.current_bet_select').prop('checked', false);
			$(this).prop('checked', true);
		}
	});
</script>