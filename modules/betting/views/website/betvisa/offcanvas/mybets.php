<div class="offcanvas offcanvas-bottom custom-canvas mybate-height bg-dark" tabindex="-1" id="mybets_offcanvas" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header bg-dark">
		<h5 class="offcanvas-title text-light m-auto" id="offcanvasBottomLabel">My Bets</h5>
		<button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-minus text-white"></i></button>
	</div>
	<div class="offcanvas-body small p-0">
		<div class="text-center my-bets-menu">
			<ul class="nav  text-center w-50 m-auto ">
				<li class="nav-item w-50 first">
					<a class="nav-link link-secondary text-dark fw-bold" id=" album-tab" data-bs-toggle="tab" data-bs-target="#album" href="#">Exchange <span class="bg-dark text-light border-radius-5 p-1 m-1">0</span></a>
				</li>
				<li class="nav-item w-50">
					<a class="nav-link link-secondary text-dark fw-bold" id=" about-tab" data-bs-toggle="tab" data-bs-target="#about" href="#">Parlay<span class="bg-dark text-light border-radius-5 p-1 m-1">0</span></a>
				</li>
			</ul>
		</div>
		<div class="tab-content bg-light" id="tabContent">
			<div class="tab-pane fade show active height57vh" id="album" role="tabpanel" aria-labelledby="album-tab">
				<h1>Exchange</h1>
			</div>
			<div class="tab-pane fade height57vh" id="about" role="tabpanel" aria-labelledby="about-tab">
				<h1>Parlay</h1>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".my-bets-menu .first a").addClass('active');
	})
	$('.my-bets-menu ul li').on('click', function(e) {
		$('.my-bets-menu ul').find('a.active').removeClass('active');
		e.target.classList.add('active');
	});
</script>