<?php $user = !empty($_SESSION['logged_in']) ? $this->db->get_where(db_prefix() . 'user', ['id' => $_SESSION['logged_in']->id])->row() :null; ?>
<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="balance" aria-labelledby="offcanvasBottomLabel">
	<div class="offcanvas-header bg-dark text-light">
		<h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Balance Overview</h5>
		<button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
	</div>
	<div class="offcanvas-body small">
		<section class="px-4 py-3 bg-dark fw-bold border-radius-5">
			<div class="fs-6 text-light border-">Your Balance</div>
			<div class="mt-1"><span class="bg-warning px-3 py-1 test-dark border-radius-5 fs-6"><?= isset($user) ? $this->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row()->name ?? '' : '' ?></span><span class="fs-6 text-light ms-2"><?= isset($user)?own_balance($user->id):'' ?></span></div>
		</section>
	</div>
</div>