<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="deposit_log" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header bg-dark text-light">
		<h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Deposit Log </h5>
		<button class="menu-cancles" type="button" onclick="bet_history_dates_close2()" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
	</div>
	<div class="offcanvas-body small">
	    
		<?php
		if (!empty($_SESSION['logged_in'])) {
			$user_id = $_SESSION['logged_in']->id;
			$result = $this->db->order_by('deposit_id', 'DESC')->get_where(db_prefix() . 'deposit_history', ['deposit_user_id' => $user_id])->result();
			$currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();

			foreach ($result as $key => $value) { ?>
				<section class="px-4 py-3 fw-bold border-radius-5 mb-3 l-bg-blue-dark">
					<div class="row">
						<div class="col-6">
							<p class="text-light m-0 ljsll dgvdgg">Transaction ID</p>
							<p class="m-2 wfgyh c"><span class="text-light">Amount : </span><span class="px-2 ms-2 py-1 currencyB fw-bold brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span><span class="text-light ms-2"> <?= $value->amount ?></span></p>
							<?php
							if ($value->status == 0) {
								echo '<p class="text-primary text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Pending...</p>';
							} else if ($value->status == 1) {
								echo '<p class="text-light text-bold text-center m-0 border-radius-5 greens py-1 px-2">Accepted</p>';
							} else if ($value->status == 2) {
								echo '<p class="text-light text-bold text-center m-0 border-radius-5 reds py-1 px-2">Rejected</p>';
							}
							?>
						</div>
						<div class="col-6 text-center">

							<p class="text-light m-0 pt-1 respText fs-10"><?= $value->transactionID ?></p>
							<span class="text-light">Deposit By <?= $value->gateway ?></span>
							<p class="text-light m-0 fs-12"><span>Date : </span> <?= $value->datetime ?></p>
						</div>
					</div>
				</section>
		<?php
			}
		
		}
		?>

	</div>
</div>