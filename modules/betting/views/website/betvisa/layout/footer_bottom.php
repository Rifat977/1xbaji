<div class="navtab-bottom bg-white text-center fixed-bottom">
    <ul class="nav nav-pills d-flex align-content-around justify-content-around" id="league-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-center home_page">
                <p><i class="fa-solid fa-home"></i></p>
                <p>Home</p>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#casino" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                <p><i class="fa-brands fa-shirtsinbulk"></p></i>
                <p>Casino</p>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link sports" id="pills-profile-tab46" data-bs-toggle="pill" data-bs-target="#sports" type="button" role="tab" aria-controls="pills-sports" aria-selected="false">
                <p><i class="fa-solid fa-baseball-bat-ball"></p></i>
                <p>Sports</p>
            </button>
        </li>
        <!-- <li class="nav-item" role="presentation">
			<a class="text-decoration-none" href="<?= base_url('sports/all_sports') ?>">
				<i class="fa-solid fa-baseball-bat-ball"></i><br> <span>Sports</span>
			</a>
		</li> -->
        <!-- <li class="nav-item" role="presentation">
			<button class="nav-link league" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#league" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
				<p><i class="fa-solid fa-trophy"></i></p>
				<p>League</p>
			</button>
		</li> -->
        <li class="nav-item" role="presentation" data-bs-toggle="offcanvas" data-bs-target="#mybets_offcanvas" aria-controls="offcanvasBottom">
            <button class="nav-link" id="pills-contact-tab">
                <p><i class="fa-solid fa-bars"></i></p>
                <p><span class="my">My</span> Bets</p>
            </button>
        </li>
    </ul>
</div>

<?php $this->load->view('website/' . $this->theme . '/offcanvas/mybets') ?>


<script>
    $('.home_page').click(function(e) {
        e.preventDefault();
        window.location.href = "<?= base_url('betting/#/') ?>";
    });
</script>