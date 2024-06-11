<div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="affiliate_offcanvas" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title fw-bold m-auto arial-font thme-white-black-text" id="offcanvasBottomLabel">Affiliate</h6>
        <button class="menu-cancles" type="button" onclick="bet_history_dates_close2()" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark text-dark thme-white-black-text"></i></button>
    </div>
    <div class="offcanvas-body small">

        <!-- <div class="page-banner-wrapper normal-width">
            <div class="banner-image">
                <img class="img-fluid rounded-3" src="https://betvisa-poster-s3.s3.ap-southeast-1.amazonaws.com/multicurrency-static-assets/en-BDT/banner-new/aff-mobile.jpg" alt="">
            </div>
        </div> -->
        <!-- <div class="container mt-3">
            <h6 class="default-title arial-font thme-white-black-text">Introduction</h6>
            <p class="arial-font line-height30 thme-white-black-text">Become a BetVisa Affiliate! Promote BetVisa and earn lifetime commission by introducing your friends, family or online audience through your affiliate referral link.</p>
        </div> -->
        <!-- <div class="page-content container prize-table">
            <h6 class="default-title thme-white-black-text">Affiliate Details</h6>
            <table class="default-table w-100">
                <tbody class="without-head">
                    <tr class="v-accent-bese rounded-3">
                        <td class="w-50 py-3  ps-2">Commission</td>
                        <td class="w-50 py-3 ps-2">50%</td>
                    </tr>
                    <tr class="rounded-3 thme-white-black-text">
                        <td class="w-50 py-3 ps-2">Platform Fee</td>
                        <td class="w-50 py-3 ps-2">18%</td>
                    </tr>
                    <tr class="v-accent-bese rounded-3">
                        <td class="w-50 py-3 ps-2">Active Player</td>
                        <td class="w-50 py-3 ps-2">5+</td>
                    </tr>
                    <tr class="rounded-3 thme-white-black-text">
                        <td class="w-50 py-3 ps-2">Net Revenue</td>
                        <td class="w-50 py-3 ps-2">BDT 1+</td>
                    </tr>
                    <tr class="v-accent-bese rounded-3">
                        <td class="w-50 py-3 ps-2">Min Payout</td>
                        <td class="w-50 py-3 ps-2">BDT 1,000</td>
                    </tr>
                    <tr class="rounded-3 thme-white-black-text">
                        <td class="w-50 py-3 ps-2">Duration</td>
                        <td class="w-50 py-3 ps-2">Monthly</td>
                    </tr>
                </tbody>
            </table>
            <div class="container default-box d-flex flex-column aling-items-center mt-3">
                <div class="description d-flex flex-column align-items-center fs-16 arial-font">
                    <span>Become an Affiliate</span>
                    <span>Earn Lifetime commission</span>
                </div>
                <button type="button" class="jwbtn w-75 py-4">
                    Join Now
                </button>
            </div>
        </div>
        <div class="container terms-wrapper mb-3">
            <h6 class="default-title thme-white-black-text">Terms and Conditions</h6>
            <div class="terms-content">
                <ol class="thme-white-black-text">
                    <li class="line-height30 arial-font">Affiliate will receive their commission on the 10th of every month.</li>
                    <li class="line-height30 arial-font">Commission is calculated with deduction of platform fee and promotion bonuses.</li>
                    <li class="line-height30 arial-font">Negative carryover is applied and settled with net revenue generated from the affiliate's downline member. Negative carryover will be carried forward to the next settlement date until the amount is zero.</li>
                    <li class="line-height30 arial-font">Affiliates will receive a minimum payout of BDT 1,000. Affiliates should have at least five (5) real money members to receive the payouts.</li>
                    <li class="line-height30 arial-font">Affiliate downlines will not include those with multiple BetVisa accounts or without an affiliate referral or tracking URL. One people only can apply one Affiliate.<br> In its sole and absolute discretion, the Company retains the right to cancel, alter, close, or add provisions to its Affiliate Program, as deemed appropriate by it. </li>
                    <li class="line-height30 arial-font">The Referral Bonus is not available to affiliates. Participation in other BetVisa promotions is possible. In case of violation, affiliates will be penalized.</li>
                    <li class="line-height30 arial-font">BetVisa <a class="fw-bold decoration-none" href="/information-center#terms">Terms and Conditions</a> apply.</li>

                </ol>
            </div>
        </div> -->

        <?php
        if (!empty($_SESSION['logged_in'])) {
            $user_id = $_SESSION['logged_in']->id;
            $result = $this->db->order_by('datetime', 'DESC')->get_where(db_prefix() . 'user', ['reference' => $user_id])->result();
            $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();
        ?>


            <section class="px-4 py-3 fw-bold border-radius-5 mb-3" style="background-color: black;">
                <div class="row">
                    <div class="col-md-6">

                        <div class="fs-5 text-light border-">Affiliate Balance: <?= number_format(user_affiliate_balance($user_id), 2)  ?></div>
                    </div>
                    <div class="col-md-6">

                        <?php if (last_withdrow_affiliate($user_id) <= date('Y-m-d') && intval(user_affiliate_balance($user_id)) > 0) { ?>
                            <button class="btn btn-primary" onclick="affiliate_withdrow()" style="float: right;">Withdrow</button>
                        <?php } ?>
                    </div>
                    <?php if (intval(user_affiliate_balance($user_id)) <= 0) { ?>
                        <p style="color:red !important" class="text-light m-0 pt-1 respText fs-11">If your balance is more than 0 and your withdrawal date is maximum 14th day then you will get withdraw button</p>
                    <?php } ?>

                </div>

            </section>
            <?php
            if ($result) {
                foreach ($result as $key => $value) {
                    $user_currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $value->currency_id])->row();
            ?>
                    <section class="px-4 py-3 fw-bold border-radius-5 mb-3" style="background-color:var(--v-accent-base) !important">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-dark m-0 ljsll dgvdgg">User : <?= $value->full_name  ?></p>
                                <p class="m-2 wfgyh c"><span class="text-dark">Amount : </span><span class="px-2 ms-2 py-1 currencyB fw-bold brTop test-dark fs-8"><?= isset($user_currency_) ? $user_currency_->name : '' ?></span><span class="text-light ms-2"><?= number_format(affiliate_history($value->id), 2) ?> </span></p>
                                <?php
                                if (affiliate_history($value->id) > 0) {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 greens py-3 px-2"></p>';
                                } else {
                                    echo '<p class="text-dark text-bold text-center m-0 border-radius-5 reds py-3 px-2"></p>';
                                }
                                ?>
                            </div>
                            <!-- <div class="col-6 text-center">

                            <p class="text-light m-0 pt-1 respText fs-10">lorem</p>
                            <span class="text-light">lorem</span>
                            <p class="text-light m-0 fs-12">lorem</p>
                        </div> -->
                        </div>

                    </section>
        <?php
                }
            }
        }
        ?>

    </div>
</div>
<script>
    function affiliate_withdrow() {
        $.ajax({
            type: "get",
            url: "<?= site_url(BETTING_MODULE_NAME . '/withdrow_affiliate') ?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                window.location.reload();
            }
        });

    }
</script>