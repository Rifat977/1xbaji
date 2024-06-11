<div class="tab-content" id="league-tabContent">
	<div class="tab-pane fade" id="casino" role="tabpanel" aria-labelledby="pills-profile-tab">
		<?php $this->load->view('website/' . $this->theme . '/pages/sports/casino') ?>

	</div>
	<div class="tab-pane fade" role="tabpanel" id="sports" aria-labelledby="pills-profile-tab">
		<?php $this->load->view('website/' . $this->theme . '/pages/sports/sports') ?>
	</div>
	<div class="tab-pane fade" id="league" role="tabpanel" aria-labelledby="pills-contact-tab">
		<?php $this->load->view('website/' . $this->theme . '/pages/sports/leagues') ?>
	</div>
</div>


<script>
	$(document).ready(function() {
		var type = '<?= isset($_GET['type']) ? $_GET['type'] : '' ?>';
		var sub_type = '<?= isset($_GET['sub_type']) ? $_GET['sub_type'] : '' ?>';

		$('#' + type).addClass('show active');
		$('.' + type).addClass('active');


		if (sub_type != '') {
			$('#all_all').removeClass('show active');
			$('.all_all').removeClass('active');
		}
		$('#' + sub_type).addClass('show active');
		$('.' + sub_type).addClass('active');
	});
</script>