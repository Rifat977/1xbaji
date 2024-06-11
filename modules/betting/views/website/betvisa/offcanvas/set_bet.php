<div class="offcanvas offcanvas-bottom" style="height: 60%;" tabindex="-1" id="set_bet" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="set_bet_title"></h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body set_bet_body">
		<h3 class="text-center bet_total"></h3>
		<form id="bet_submit_form">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
			<div class="">
				<div class="d-flex calculate-top justify-content-between">
					<input type="hidden" name="sport_id" id="sport_id" value="">
					<input type="hidden" name="sport_key" id="sport_key" value="">
					<input type="hidden" name="bet_name" id="bet_name">
					<input type="hidden" name="bet_key" id="bet_key">
					<input type="hidden" name="bet_type" id="bet_type">
					<input type="hidden" name="bet_team" id="bet_team">
					<div class="top-left bg-light plus-minus">
						<p>Odds</p>
						<button class="btn pm-btn p-0" disabled><i class="fa-solid fa-minus"></i></button> <input type="text" class="d-inline-block form-control get_point" readonly> <button class="btn pm-btn p-0" disabled><i class="fa-solid fa-plus"></i></button>
					</div>
					<div class="top-right bg-light plus-minus">
						<p>Stake</p>
						<button class="btn pm-btn btn-warning t-minus"><i class="fa-solid fa-minus"></i></button> <input type="text" class="d-inline-block form-control stake_input" name="stake_input" value="0" maxlength="4"> <button class="btn pm-btn btn-warning t-plus"><i class="fa-solid fa-plus"></i></button>
					</div>
				</div>
				<div class="row text-center add_btn mt-3">
					<div class="col-lg-11 col-md-11 col-10">
						<div class="addbuttons">
							<div class="">
								<span class="btn btn-warning" onclick="add_plus(<?= isset($user) ? $user->stack1 : 0 ?>)">+<?= isset($user) ? $user->stack1 : 0 ?></span>
							</div>
							<div class="">
								<span class="btn btn-warning" onclick="add_plus(<?= isset($user) ? $user->stack2 : 0 ?>)">+<?= isset($user) ? $user->stack2 : 0 ?></span>
							</div>
							<div class="">
								<span class="btn btn-warning" onclick="add_plus(<?= isset($user) ? $user->stack3 : 0 ?>)">+<?= isset($user) ? $user->stack3 : 0 ?></span>
							</div>
							<div class="">
								<span class="btn btn-warning" onclick="add_plus(<?= isset($user) ? $user->stack4 : 0 ?>)">+<?= isset($user) ? $user->stack4 : 0 ?></span>
							</div>
						</div>
					</div>
					<div class="col-lg-1 col-md-1 col-2 p-0">
						<button class="btn btn-warning" onclick="deafult_stake()"><i class="fa-solid fa-gear"></i></button>
					</div>
				</div>
				<div class="keyboard-calculator mt-2">
					<div class="row outer-keys">
						<div class="col-12">
							<div class="inner-keys">
								<div class="btn" onclick="keys('1')">1</div>
								<div class="btn" onclick="keys('2')">2</div>
								<div class="btn" onclick="keys('3')">3</div>
								<div class="btn" onclick="keys('4')">4</div>
								<div class="btn" onclick="keys('5')">5</div>
								<div class="btn" onclick="keys('6')">6</div>
								<div class="btn" onclick="keys('7')">7</div>
								<div class="btn" onclick="keys('8')">8</div>
								<div class="btn" onclick="keys('9')">9</div>
								<div class="btn" onclick="keys('0')">0</div>
								<div class="btn" onclick="keys('00')">00</div>
								<div class="btn" onclick="cross_end()"><i class="fa-solid fa-arrow-left"></i></div>
							</div>
						</div>
					</div>
					<span class="badge bg-info max_limit float-end my-2">Max 5000</span>
				</div>
				<div>
					<button type="submit" class="btn btn-warning w-100 my-3 place_bet">Place Bet</button>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="offcanvas offcanvas-bottom bg-dark" style="height: 60%;" tabindex="-1" id="default_stake" aria-labelledby="default_stakeLabel">
	<div class="offcanvas-header bg-dark">
		<h5 class="offcanvas-title text-white" id="default_stakeLabel">Default Stake Setting</h5>
		<button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-close"></i></button>
	</div>
	<form id="stack_setting_form">
		<div class="offcanvas-body small">
			<div class="default_stake_input position-relative">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
				<div class="stake_inputs">
					<input type="hidden" id="user_id" name="user_id" value="<?= isset($user) ? $user->id : 0 ?>">
					<div class="row ">
						<div class="col-3">
							<input type="text" class="form-control text-center fw-bold" value="<?= isset($user) ? $user->stack1 : 0 ?>" name="stack1" id="input_1st" onclick="get_input_id(this.id)">
						</div>
						<div class="col-3">
							<input type="text" class="form-control text-center fw-bold" value="<?= isset($user) ? $user->stack2 : 0 ?>" name="stack2" id="input_2nd" onclick="get_input_id(this.id)">
						</div>
						<div class="col-3">
							<input type="text" class="form-control text-center fw-bold" value="<?= isset($user) ? $user->stack3 : 0 ?>" name="stack3" id="input_3rd" onclick="get_input_id(this.id)">
						</div>
						<div class="col-3">
							<input type="text" class="form-control text-center fw-bold" value="<?= isset($user) ? $user->stack4 : 0 ?>" name="stack4" id="input_4th" onclick="get_input_id(this.id)">
						</div>
					</div>
				</div>
				<div class="setting_keys my-2 p-4">
					<div class="inner-keys row">
						<div class="btn col-4" onclick="set_keys('1')">1</div>
						<div class="btn col-4" onclick="set_keys('2')">2</div>
						<div class="btn col-4" onclick="set_keys('3')">3</div>
						<div class="btn col-4" onclick="set_keys('4')">4</div>
						<div class="btn col-4" onclick="set_keys('5')">5</div>
						<div class="btn col-4" onclick="set_keys('6')">6</div>
						<div class="btn col-4" onclick="set_keys('7')">7</div>
						<div class="btn col-4" onclick="set_keys('8')">8</div>
						<div class="btn col-4" onclick="set_keys('9')">9</div>
						<div class="btn col-4 bg-white"></div>
						<div class="btn col-4" onclick="set_keys('0')">0</div>
						<div class="btn col-4" onclick="set_cross_end()"> <i class="fa-solid fa-arrow-left"></i></div>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-warning w-100 submit_setup rounded-0">Submit</button>
	</form>
</div>

<div class="offcanvas offcanvas-bottom zIndex10 bg-dark" tabindex="-1" id="betOffcanvas" aria-labelledby="offcanvasBottomLabel" style="height:40% !important;">
	<div class="offcanvas-header bg-dark text-light">
		<h3 class="offcanvas-title fw-bold m-auto text-primary pop-outin" id="offcanvasBottomLabel">Success!</h3>
		<button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
	</div>
	<div class="offcanvas-body brTse small menu-bg">
		<p class="text-success fs-3">Your bet is successful, you can bet again.</p>
	</div>
</div>
<script>
	$('#bet_submit_form').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: "post",
			url: "<?= base_url('betting/place_bet') ?>",
			data: $(this).serialize(),
			dataType: "json",
			success: function(data) {
				if (typeof(data.error) == 'undefined') {
					// alert(data.message);
					$('#betOffcanvas').offcanvas('show');
					$('#set_bet').offcanvas('hide');
					refresh_balance(<?= isset($user) ? $user->id : 0 ?>);
				} else {
					alert(data.message);
				}
			}
		});
	});


	var sum = 0;

	$('.get_point').keypress(function(event) {
		if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
			event.preventDefault();
		}
	});

	$('.stake_input').keyup(function(e) {
		var val = Number($(this).val()).toFixed(4);
		if (val > 5000) {
			$(".max_limit").show();
			$('.place_bet').attr('disabled', true);
		} else {
			$('.max_limit').hide();
			if (val == '' || val == 0) {
				$('.place_bet').attr('disabled', true);
			} else {
				$('.place_bet').attr('disabled', false);
			}
		}

		var get_point = $('.get_point').val();
		var total = ((get_point * val)).toFixed(2);
		$('.bet_total').html('Estimate Price: ' + (total - val).toFixed(2));
	});

	$('.top-right .t-minus').click(function(e) {
		e.preventDefault();
		var value = Number($('.stake_input').val());
		if (value > 0) {
			value = value - 1;
		}
		$('.stake_input').val(value).keyup();
	});
	$('.top-right .t-plus').click(function(e) {
		e.preventDefault();
		var value = Number($('.stake_input').val());
		if (value >= 0) {
			value = value + 1;
		}
		$('.stake_input').val(value).keyup();
	});

	function add_plus(num) {
		var value = Number($('.stake_input').val());
		value = value + num;
		$('.stake_input').val(value).keyup();
	}

	function keys(num) {
		var value = $('.stake_input').val();
		if (Number(value) == 0 && Number(num) != 0) {
			$('.stake_input').val(num).keyup();
		} else if (Number(value) != 0) {
			$('.stake_input').val(value + num).keyup();
		}
	}

	function cross_end() {
		var value = $('.stake_input').val();
		value = value.slice(0, -1);
		$('.stake_input').val(value).keyup();
	}


	function deafult_stake() {
		$("#default_stake").offcanvas('show');
	}

	$('#stack_setting_form').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: "post",
			url: "<?= base_url('betting/stack_setting') ?>",
			data: $(this).serialize(),
			dataType: "json",
			success: function(data) {
				if (data != '') {
					$("#default_stake").offcanvas('hide');
					window.location.reload();
				}
			}
		});
	});


	var set_input_id = '';

	function get_input_id(id) {
		set_input_id = id;
		console.log(set_input_id);
	}

	function set_keys(num) {
		if (set_input_id != '') {
			var value = $('#' + set_input_id).val();
			if (Number(value) == 0 && Number(num) != 0) {
				$('#' + set_input_id).val(num).keyup();
			} else if (Number(value) != 0) {
				$('#' + set_input_id).val(value + num).keyup();
			}
		}
	}


	function set_cross_end() {
		var value = $('#' + set_input_id).val();
		value = value.slice(0, -1);
		$('#' + set_input_id).val(value);
	}
</script>