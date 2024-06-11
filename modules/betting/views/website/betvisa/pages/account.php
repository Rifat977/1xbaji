<?php !empty($this->session->userdata('logged_in')) ? $user = $this->db->get_where(db_prefix() . 'user', ['id' => $_SESSION['logged_in']->id])->row() : '' ?>
<div class="profile-section position-relative ">
    <div class="container">
        <div class="d-flex align-items-center tab-btn-bgsoft mt-2 mb-3 py-3 px-3">
            <div><i class="fa-regular fa-user fs-18  acount-icons"></i></div>
            <div class="d-flex flex-column fs-14 ms-2">
                <span>Hellow,</span>
                <span><?= isset($user) ? $user->full_name : '' ?></span>
            </div>
        </div>
        <div class="v-acount-list">
            <div class="row">
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#profile_edite_setlfjflsdjf" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item">
                                <div class="v-acount-item-icon">
                                    <i class="fa-regular fa-user fs-18  acount-icons"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Profile</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#profile_password_change" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-lock fs-18"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Passwo...</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#account_bank" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-building-columns fs-18"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Bank</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div> -->
                <!-- <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-wallet fs-18"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Wallet</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div> -->
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#deposit_log_modal" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Deposit</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#withdraw_log_modal" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-money-bill-1"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Withdraw</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#bet_history_modal" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>History</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="#bet_bonus_modal" data-bs-toggle="offcanvas">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Bonus</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="v-acont-list-setting">
                        <a class="decoration-none" href="<?= base_url('betting/logout') ?>">
                            <div class="tab-btn-bgsoft v-list-item ">
                                <div class="v-acount-item-icon">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                <div class="v-acount-item-name">
                                    <div>Logout</div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="reward-overview mt-3 ">
            <!-- <h6 class="custom-header default-title thme-white-black-text">My Rewards</h6>
            <div class="reward-wrapper flex-column mt-2">
                <div class="vip-milestone-wrapper py-3 rounded-3">
                    <div class="tier-progress-bar-wrapper">
                        <div class="header d-flex align-items-center ps-3">
                            <img data-src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/Bronze.ed0130a.png" alt="vip" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/Bronze.ed0130a.png" lazy="loaded">
                            <div class="name">VIP Bronze</div>
                        </div>
                        <div class="tier-progress-bar mt-3">
                            <div class="progress-bar-wrapper">
                                <div class="bar-item">
                                    <div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" class="v-progress-linear progress-bar v-progress-linear--visible theme--light" style="height: 4px;">
                                        <div class="v-progress-linear__background primary" style="opacity: 0.3; left: 0%; width: 100%;"></div>
                                        <div class="v-progress-linear__buffer"></div>
                                        <div class="v-progress-linear__determinate primary" style="width: 0%;"></div>
                                    </div>
                                    <div class="first-step">
                                        <div class="box-outline default-center"></div>
                                        <div class="tag"><span> Bet Amount:</span> <span class="amount font-teko">0/1,000,000</span></div>
                                    </div>
                                    <div class="step"><img data-src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/Silver.4fb4dc8.png" alt="vip" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/Silver.4fb4dc8.png" lazy="loaded">
                                        <div class="name">Silver</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-btn-bgsoft mt-3 p-3 rounded-3 d-flex justify-content-between align-items-center">
                    <div class="item-left d-flex align-items-center">
                        <i class="fa-regular fa-life-ring fs-20"></i>
                        <div class="ms-3">
                            <span class="fw-bold">Spin &amp; Win</span> <span class="ticket"> <br>10</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark rounded-pill w-110  py-2">
                        Spin
                    </button>
                </div>
                <div class="tab-btn-bgsoft mt-3 p-3 rounded-3 d-flex justify-content-between align-items-center">
                    <div class="item-left d-flex align-items-center">
                        <i class="fa-solid fa-hands-holding-circle fs-20"></i>
                        <div class="ms-3">
                            <span class="fw-bold">Spin &amp; Win</span> <span class="ticket"> <br>0</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark rounded-pill w-110  py-2">
                        Redeem
                    </button>
                </div>
            </div> -->
            <div class="mt-3">
                <h6 class="custom-header default-title thme-white-black-text">Referral</h6>
                <div class="referral tab-btn-bgsoft px-3 py-4 rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-link fs-20 me-3"></i>
                        <div class="w-100" id="text-to-copy" style="font-size:12px"><?= base_url('betting/registration?ref=' . $_SESSION['logged_in']->id) ?></div>
                        <!-- <input id="referral_link" class="w-100 referral-link" type="text" value="http://valkey.apitsoft.com/betting/acount" readonly> -->
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <button type="button" onclick="refer_link_copy()" class="btn btn-warning w-50 py-2 rounded-pill me-2 position-relative copied-btn">Copy
                        <div class="copied-btn-icon"><i class="fa-regular fa-circle-check"></i></div>
                    </button>
                    <!-- <button type="button" id="refer_link_share" class="btn btn-dark w-50 rounded-pill py-2 ms-2">Share</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="link_share" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-body small">
        <div class="referral-link-share bg-white w-100 mt-4">
            <div class="link-items text-center">
                <div class="fw-bold">INVITE VIA</div>
                <div class="d-flex justify-content-center mt-3">
                    <a href="https://www.facebook.com/" target="_blank" class="share-social-facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://www.whateapps.com/" target="_blank" class="share-social-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.telegram.com/" target="_blank" class="share-social-telegram">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="profile_edite_setlfjflsdjf" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-center thme-white-black-text" id="offcanvasBottomLabel">Profile</h5>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div class="account-mobile-view-wrapper">
            <div class="profile-wrapper">
                <div class="item thme-white-black-text">
                    <span class="label">Full Name</span>
                    <span class="value"><?= isset($user) ? $user->full_name : '' ?></span>
                </div>
                <div class="item thme-white-black-text">
                    <span class="label">Username</span>
                    <span class="value"><?= isset($user) ? $user->user_name : '' ?></span>
                </div>
                <div class="item thme-white-black-text">
                    <span class="label">Email</span>
                    <span class="value"><?= isset($user) ? $user->user_email : '' ?></span>
                </div>
                <div class="item thme-white-black-text">
                    <span class="label">Mobile</span>
                    <span class="value">
                        <span><?= isset($user) ? $user->mobile : '' ?></span>
                        <button type="button" class="btn rounded-pill bg-suc ms-3" onclick="mobile_number_modal()" style="padding:0px 6px">
                            <i class="fa-solid fa-plus text-light fs-12 "></i>
                        </button>
                    </span>
                </div>
                <!-- <div class="item">
                    <span class="label">D.O.B</span>
                    <span class="value">
                        <button type="button" class="btn rounded-pill ms-3 bg-suc " onclick="mobile_dob()" style="padding:0px 6px">
                            <i class="fa-solid fa-plus text-light fs-12"></i>
                        </button>
                    </span>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="profile_password_change" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Password Change</h6>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <div class="container">
                <form class="form-inline change-password-form" id="change_password_form">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <div class="mb-3">
                        <label class="thme-white-black-text" for="">Old Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" name="old_password" id="old-password-field">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                        <span id="old_passwordErr"></span>
                    </div>
                    <div class="mb-3">
                        <label class="thme-white-black-text" for="">New Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" name="password" id="npassword-field">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                        <span id="passwordErr"></span>
                    </div>
                    <div class="mb-3">
                        <label class="thme-white-black-text" for="">Comfirm Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" name="confirm_password" id="cpassword-field">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                        <span id="confirm_passwordErr"></span>
                    </div>
                    <button type="submit" class="changebtn thme-white-black-text">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="deposit_log_modal" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Deposit Log</h6>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <?php
            if (!empty($_SESSION['logged_in'])) {
                $user_id = $_SESSION['logged_in']->id;
                $result = $this->db->order_by('deposit_id', 'DESC')->get_where(db_prefix() . 'deposit_history', ['deposit_user_id' => $user_id])->result();
                $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();

                foreach ($result as $key => $value) { ?>
                    <section class="px-4 py-3 fw-bold rounded-3 mb-3" style="background-color:var(--v-accent-base) !important">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-dark m-0 ljsll dgvdgg">Transaction ID</p>
                                <p class="m-2 wfgyh c"><span class="text-dark" style="font-size: 10px;">Amount : </span><span class="px-2 ms-2 py-1 currencyB fw-bold brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span><span class="text-dark ms-2" style="font-size: 10px;"> <?= $value->amount ?></span></p>
                                <?php
                                if ($value->status == 0) {
                                    echo '<p class="text-primary text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Pending...</p>';
                                } else if ($value->status == 1) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 greens py-1 px-2">Accepted</p>';
                                } else if ($value->status == 2) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 reds py-1 px-2">Rejected</p>';
                                }
                                ?>
                            </div>
                            <div class="col-6 text-center">

                                <p class="text-dark m-0 pt-1 respText fs-10"><?= $value->transactionID ?></p>
                                <span class="text-dark">Deposit By <?= $value->gateway ?></span>
                                <p class="text-dark m-0 fs-12"><span>Date : </span> <?= $value->datetime ?></p>
                            </div>
                        </div>

                    </section>
            <?php
                }
            }
            $callback = $this->db->get_where('tblbet_callback',['user_id'=>$user_id,'is_deposit'=>1])->result();
			foreach($callback as $val){ ?>
			    
			    <section class="px-4 py-3 fw-bold border-radius-5 mb-3 l-bg-blue-dark">
					<div class="row">
						<div class="col-6">
							<p class="text-light m-0 ljsll dgvdgg">Transaction ID</p>
							<p class="m-2 wfgyh c"><span class="text-light">Amount : </span><span class="px-2 ms-2 py-1 currencyB fw-bold brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span><span class="text-light ms-2"> <?= $val->amount ?></span></p>
							<?php
							if ($val->status == 0 || $val->status == 1) {
								echo '<p class="text-primary text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Pending...</p>';
							} else if ($val->status == 2) {
								echo '<p class="text-light text-bold text-center m-0 border-radius-5 greens py-1 px-2">Accepted</p>';
							} else if ($val->status == 3) {
								echo '<p class="text-light text-bold text-center m-0 border-radius-5 reds py-1 px-2">Rejected</p>';
							}
							?>
						</div>
						<div class="col-6 text-center">

							<p class="text-light m-0 pt-1 respText fs-10"><?= $val->order_no ?></p>
							<span class="text-light">Deposit By Online</span>
							<p class="text-light m-0 fs-12"><span>Date : </span> <?= $val->date ?></p>
						</div>
					</div>
				</section>
			    
			<?php 
			    
			} 
            ?>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="withdraw_log_modal" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Withdraw Log</h6>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <?php
            if (!empty($_SESSION['logged_in'])) {
                $user_id = $_SESSION['logged_in']->id;
                $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();
                $ress = $this->db->get_where(db_prefix() . 'withraw_history', ['user_id' => $user_id])->result();
                foreach ($ress as $k => $val) {
            ?>
                    <section class="px-4 py-3 fw-bold rounded-3 mb-3" style="background-color:var(--v-accent-base) !important">
                        <div class="row">
                            <div class="col-8">
                                <p class="m-0 d-flex align-items-center"><span class="text-dark" style="font-size: 10px;">Amount</span><span class="currencyB fw-bold px-2 ms-2 py-1 brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span><span class="text-dark ms-2" style="font-size: 10px;"> <?= $val->amount ?></span></p>
                                <span class="text-dark">Withdraw By <?= $val->type ?></span>
                                <p class="text-dark m-0 fs-10"><span>Date :</span><?= $val->datetime ?></p>
                            </div>
                            <div class="col-4 p-0">
                                <?php
                                if ($val->status == 0) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Holding...</p>';
                                } else if ($val->status == 1) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 greens py-1 px-2">Accepted</p>';
                                } else if ($val->status == 2) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 reds py-1 px-2">Rejected</p>';
                                }
                                ?>
                            </div>
                        </div>

                    </section>
            <?php }
            }
            ?>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="bet_history_modal" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Bet History</h6>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <?php
            if (!empty($_SESSION['logged_in'])) {
                $today = date('Y-m-d');
                $game_history = $this->db->limit(25)->order_by("create_date", "asc")->get_where(db_prefix() . 'games', ['user_id' => $_SESSION['logged_in']->id])->result();
                // echo json_encode($game_history);

                if ($game_history) {
                    foreach ($game_history as $k => $v) {
                        $game_name = $this->db->get_where(db_prefix() . 'bet_game_list', ['game_code' => $v->GameID])->row();
            ?>

                        <section class="px-4 py-3 fw-bold border-radius-5 mb-3" style="background-color:var(--v-accent-base) !important">
                            <div class="row">
                                <div class="col-8">
                                    <p class="fs-5 text-dark mb-0" data-bs-toggle="tooltip" title="Bet Name"> <?= $game_name->game_name ?></p>
                                    <p class="m-0 d-flex">
                                        <span class="text-dark">Amount</span>
                                        <span class="currencyB fw-bold px-2 ms-2 py-1 brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span>
                                        <span class="text-dark ms-2 font-size-16"> <?= (isset($v->total)) ? $v->total : '' ?></span>
                                    <p class="text-dark mt-1 fs-10"><?= date('D d M Y H:i:s', strtotime((isset($v->datetime)) ? $v->datetime : '')) ?></p>
                                    </p>
                                </div>
                                <div class="col-4 text-center p-0">
                                    <?php
                                    if (isset($v->action)) {
                                        if ($v->action == 'settle') {
                                            echo '<p class="text-dark text-bold text-center m-0 border-radius-5 greens py-1 px-2">Win</p>';
                                        } else if ($v->action == 'bet') {
                                            echo '<p class="text-dark text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Bet</p>';
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </section>
            <?php }
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="bet_bonus_modal" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Bonus</h6>
        <button type="button" class="btn thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <?php
            if (!empty($_SESSION['logged_in'])) {
                $today = date('Y-m-d');
                $bonuse = $this->db->get_where(db_prefix() . 'bet_bonus', ['user_id' => $_SESSION['logged_in']->id])->row();

            ?>

                <div class="fs-5 thme-white-black-text"> Bonus Amount : <span class="teko-font fw-bold"><?= isset($bonuse) ? number_format($bonuse->total_amount, 2) : '0.00' ?></span></div>
                <hr class="w-100 bg-secondary " style="height: 1px;" />
                <?php if ($bonuse) { ?>
                    <section class="px-4 py-3 fw-bold rounded-3 mb-3" style="background-color:var(--v-accent-base) !important">
                        <div class="row">
                            <div class="col-8">
                                <div class="fs-7"> Deposit Amount : <span class="teko-font fw-bold"><?= isset($bonuse) ? number_format($bonuse->amount, 2) : '0.00' ?></span></div>
                                <div class="fs-7"> Persent : <span class="teko-font fw-bold">10 %</span></div>
                                <div class="fs-7"> Total Amount : <span class="teko-font fw-bold"><?= isset($bonuse) ? number_format($bonuse->total_amount, 2) : '0.00' ?></span></div>
                                <div class="fs-7"> Date : <span class="teko-font fw-bold"><?= isset($bonuse) ? $bonuse->create_at : '' ?></span></div>
                            </div>
                            <div class="col-4 p-0">
                                <p class="text-dark text-bold text-center m-0 border-radius-5 greens py-1 px-2">Win</p>
                            </div>
                        </div>

                    </section>

                    <!-- <section class="px-4 py-3 fw-bold rounded-3 mb-3" style="background-color:var(--v-accent-base) !important">
                    <div class="row">
                        <div class="col-8">
                            <div class="fs-7"> Deposit Amount : <span class="teko-font fw-bold"><?= number_format($bonuse->total_amount, 2) ?></span></div>
                            <div class="fs-7"> Persent : <span class="teko-font fw-bold">10 %</span></div>
                            <div class="fs-7"> Total Amount : <span class="teko-font fw-bold">50.00</span></div>
                            <div class="fs-7"> Date : <span class="teko-font fw-bold"><?= date('Y/m/d') ?></span></div>
                        </div>
                        <div class="col-4 p-0">
                        <p class="text-dark text-bold text-center m-0 border-radius-5 greens py-1 px-2">Deposit</p>
                        </div>
                    </div>

                </section> -->

            <?php }
            }
            ?>
        </div>
    </div>
</div>



<div class="modal fade modal-common-shadow border-none" id="mobile_number_modal" aria-hidden="true" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content default-modal-content">
            <div class="modal-body">
                <div class="">
                    <div class="text-center fs-16 fw-bold">
                        Add New Phone Number
                    </div>
                    <form class="mt-3">
                        <div class="d-flex mobile_number_update align-items-center ">
                            <div class="ms-3">+880</div>
                            <input class="w-100 fs-14" type="text" placeholder="Mobile Number">
                        </div>
                        <div class="mobile-btn-reuest d-flex align-items-center me-2 mt-3">
                            <button type="button" class="btn otp-request-btn">
                                Request OTP
                            </button>
                            <button type="button" class="btn modal-cancle-btn ms-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-common-shadow border-none" id="profile_dob" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content default-modal-content">
            <div class="modal-body">
                <div class="">
                    <div class="text-center fs-16 fw-bold">
                        Add Date of Birth
                    </div>
                    <form class="mt-3">
                        <div class="d-flex mobile_number_update align-items-center ">
                            <input class="w-100 fs-14 px-3" type="date" placeholder="Mobile Number">
                        </div>
                        <div class="mobile-btn-reuest d-flex align-items-center me-2 mt-3">
                            <button type="button" class="btn otp-request-btn">
                                Request OTP
                            </button>
                            <button type="button" class="btn modal-cancle-btn ms-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function mobile_dob() {
        $('#profile_dob').modal('show');
    }


    function mobile_number_modal() {
        $('#mobile_number_modal').modal('show')
    }

    function profile_acounts() {
        $('#profile_acount').offcanvas('show')
    }

    function refer_link_copy() {
        $('.copied-btn-icon').css('opacity', '1');
        var textToCopy = $('#text-to-copy').text();
        var tempTextarea = $('<textarea>');
        $('body').append(tempTextarea);
        tempTextarea.val(textToCopy).select();
        document.execCommand('copy');
        tempTextarea.remove();

    }
    $('.copied-btn').blur(function() {
        ('.copied-btn-icon').css('opacity', '0 !important');
    })

    $('#refer_link_share').click(function() {
        $('#link_share').offcanvas('show')
    })
    $('#refer_link_share').blur(function() {
        $(this).css('bottom', '-220px');
        $(this).show();
    })



    $('#change_password_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/update_user_password') ?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {

                if (data.error) {
                    $.each(data, function(i, v) {
                        if (v != '') {
                            $('#' + i).html(v);
                        } else {
                            $('#' + i).html('');
                        }

                    });
                } else {
                    window.location.href = data;
                }
            }
        });
    });
</script>