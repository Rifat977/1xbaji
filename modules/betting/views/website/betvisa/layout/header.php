    <?php $website =  $this->db->get_where(db_prefix() . 'website')->row();
    !empty($_SESSION['logged_in']) ? $user = $this->db->get_where('tbluser', ['id' => $_SESSION['logged_in']->id])->row() : '';
    ?>
    <header class="">
        <div class="d-flex justify-content-between align-items-center p-2 top_header">
            <div class="d-flex align-items-center">

                <?php
                $type = '';
                if (isset($_GET['type'])) {
                    $type = $_GET['type'];
                }

                if ($this->uri->segment(2) != 'match_detail') {
                    echo '<a class="btn rounded-pill p-0 " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="background:#f4f4f4;">
                    <div class="v-mini-btn">
                    <i class="fa-solid fa-bars" style="font-size:18px"></i>
                    </div>
    				</a>';
                } else if ($this->uri->segment(2) == 'match_detail') {
                    echo '<a class="btn" href="' . base_url('betting/all_sports?type=' . $type) . '">
    					<i class="fa-solid fa-chevron-left" style="font-size:20px"></i>
    				</a>';
                }
                ?>
                <a class="ms-1" href="<?= base_url('betting/#/') ?>">
                    <!-- <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>" style="width: 96px;height: 50px;"> -->
                    <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>" style="width: 100px;height: 36px;">
                </a>
            </div>
            <?php
            if (!is_null($this->session->userdata('logged_in'))) { ?>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <div class="text-center me-1 header-amount teko-font">
                            <!-- <button class="btn"> <i class="fa-solid fa-sack-dollar"></i> -->
                            <!-- <i class="fa-solid fa-rotate" style="font-size:20px;cursor:pointer;" onclick="refresh_balance('<?= $user->id ?>')"></i> -->
                            <!-- </button> -->
                             <span style="color:#8f6e05;font-weight:700;"><?= isset($user) ? ($this->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row()->name ?? '') : '' ?></span> 
                            <!--<span><i class="fa-solid fa-sack-dollar"></i></span>-->
                            <span id="own_balance"><?= isset($user) ? own_balance($user->id) : '' ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <!-- <a class="bg-dark decoration-none text-light rounded-pill" data-bs-toggle="offcanvas" href="#withdraw" role="button" aria-controls="offcanvasExample">
                            <div class="v-mini-btn">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                        </a> -->
                        <a class="yellow-bg rounded-pill decoration-none me-1" href="<?= base_url('betting/deposit_widthraw') ?>">
                            <div class="v-mini-btn">
                                <i class="fa-solid fa-plus text-dark"></i>
                            </div>
                        </a>

                    </div>
                </div>
            <?php } else { ?>
                <div class="sign-up-login d-flex align-items-center">
                    <a href="<?= base_url('betting/registration') ?>" class="btn btn-signup-warning fw-bold">
                        SignUp
                    </a>
                    <a href="<?= base_url('betting/login') ?>" class="btn btn-login-dark fw-bold">
                        Login
                    </a>
                </div>
            <?php } ?>
        </div>
    </header>


    <?php $type = $this->db->order_by('order_by')->get_where('tblbet_game_type', ['is_active' => 1])->result(); ?>

    <div class="offcanvas offcanvas-start menu-offcanvas" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"> <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>" style="width: 120px;height: 27px;"></h5>
            <div class="d-flex align-items-center">
                <a onclick="night_Day_mode()" class="bg-dark decoration-none text-light rounded-pill v-night-mode-btn" style="width: 30px; height:30px">
                    <div class="v-mini-btn mb-2" style="width: 30px; height:30px;">
                        <i id="theme_icons" class="fa-solid fa-moon"></i>
                    </div>
                </a>
                <button type="button" class=" btn text-reset thme-white-black-text fs-5" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <hr class="m-auto w88" style="height:2px">
        <div class="offcanvas-body">
            <!-- <div onclick="like_search_game()" class="search-game-wrapper">
                <div class="game-label">Search Games</div>
                <i class="fa-solid fa-magnifying-glass fs-20"></i>
            </div> -->
            <ul class="canvas-menu">
                <li>
                    <a href="<?= base_url() ?>"><i class="fa-solid fa-house me-3"></i>Home</a>
                </li>
                <li data-bs-toggle="offcanvas" href="#">
                    <a href="<?= base_url('betting/promotions') ?>"><i class="fa-solid fa-gift me-3"></i>Promotions</a>
                </li>
                <!--<li data-bs-toggle="offcanvas" href="#vip_offcanvas">-->
                <!--    <a role="button"><i class="fa-solid fa-crown me-3"></i>VIP</a>-->
                <!--</li>-->
                <!-- <li data-bs-toggle="offcanvas" href="#reword_point_offcanvas">
                    <a role="button"><i class="fa-solid fa-hands-holding-circle me-3"></i>Reward Point</a>
                </li>
                <li data-bs-toggle="offcanvas" href="#spin_win_offcanvas">
                    <a role="button"><i class="fa-regular fa-life-ring me-3"></i>Spin & Win</a>
                </li> -->
                <li data-bs-toggle="offcanvas" href="#referral_offcanvas">
                    <a role="button"><i class="fa-solid fa-users-gear me-3"></i>Referral</a>
                </li>
                <hr class="w-100 m-auto" style="height:1px;" />
                <?php foreach ($type as $key) { ?>
                    <li style="padding: 7px;">
                        <a href="#" onclick="transfer_slider(<?= $key->type_id ?>)">
                            <img class="v-tab-icon" style="border-radius: 61%;
                                margin-left: -3px;
                                width: 40px !important;
                                height: 40px !important;
                                background-color: transparent;" src="<?= base_url('modules/betting/upload/game-type/' . $key->type_image) ?>" alt=""><span style="margin-left:15px"><?= $key->type_name ?></span></a>
                    </li>
                <?php } ?>

                <hr class="w-100 m-auto" style="height: 1px;">

                <!-- <li>
                    <a href="#"><i class="fa-solid fa-phone-volume me-3"></i>Contact </a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-cube me-3"></i>Blog </a>
                </li> -->
                <li>
                    <a data-bs-toggle="offcanvas" href="#affiliate_offcanvas"><i class="fa-regular fa-handshake me-3"></i>Affiliate</a>
                </li>
                <li>
                    <a><i class="fa-solid fa-shuffle me-3"></i>Brand Ambassador</a>
                </li>
                <li>
                    <a><i class="fa-regular fa-circle-down me-3"></i>Download App</a>
                </li>
                <hr class="w-100" style="height: 1px;">

                <li>
                    <a data-bs-toggle="offcanvas" href="#terms_condition_offcanvas"><i class="fa-solid fa-head-side-cough me-2"></i>Terms & Conditions </a>
                </li>
                <li>
                    <a href="#faq_offcanvas" data-bs-toggle="offcanvas"><i class="fa-solid fa-clipboard-question me-3"></i>FAQ</a>
                </li>
                <!--<li>-->
                <!--    <a href="#"><i class="fa-solid fa-clipboard-question me-3"></i>Privacy Policy</a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <a href="#"><i class="fa-solid fa-plug-circle-minus me-3"></i>Disconnection Policy</a>-->
                <!--</li>-->
                <li>
                    <a href="#responsible_gambling_offcanvas"  data-bs-toggle="offcanvas"><i class="fa-solid fa-hands-holding-child me-3"></i>Responsible Gambling</a>
                </li>

                <hr class="w-100 m-auto" style="height:1px;" />
            </ul>
            <div class="">
                <div class="menu-social-icons d-flex mt-3 justify-content-between">
                    <a href="https://www.facebook.com/" target="_blank" class="menu-social-facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://www.whateapps.com/" target="_blank" class="menu-social-whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="menu-social-instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.email.com/" target="_blank" class="menu-social-email">
                        <i class="fa-regular fa-envelope"></i>
                    </a>

                    <a href="https://www.telegram.com/" target="_blank" class="menu-social-telegram">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                    <a href="https://www.twitter.com/" target="_blank" class="menu-social-twitter">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start menu-offcanvas h-92vh " tabindex="-1" id="seach_offcanvas" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="">
                <input class="search_items_game" type="text" placeholder="Search Games">
            </div>

        </div>
    </div>


    <div class="offcanvas offcanvas-bottom h-92vh default-offcanvas" tabindex="-1" id="reword_point_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Reword Point</h6>
            <button type="button" class="bg-transparent border-0 fs-5 .thme-white-black" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="page-banner-wrapper normal-width">
                            <div class="banner-image">
                                <img class="img-fluid rounded-3" src="https://betvisa-poster-s3.s3.ap-southeast-1.amazonaws.com/multicurrency-static-assets/en-BDT/banner-new/reward-mobile.jpg" alt="">
                            </div>
                        </div>
                        <div class="container mt-3">
                            <h6 class="default-title arial-font">Introduction</h6>
                            <p class="arial-font line-height30"><?= get_option('company_name')  ?> Players can earn Reward Points on every valid bet in all of the games. These Reward Points can be exchanged for cash and other rewards with additional incentives to continue playing and enjoying the <?= get_option('company_name')  ?> experience.</p>
                        </div>
                        <div class="container default-box d-flex flex-column aling-items-center">
                            <div class="description d-flex flex-column align-items-center fs-16 arial-font">
                                <span>Reward Points</span>
                                <span>Convert to Real Cash</span>
                            </div>
                            <button type="button" class="jwbtn w-75 py-4">
                                Join Now
                            </button>
                        </div>
                        <div class="container terms-wrapper">
                            <h6 class="default-title">Terms and Conditions</h6>
                            <div class="terms-content">
                                <ol>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to modify or amend the Terms and Conditions. A notification will be sent to <?= get_option('company_name')  ?> players.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?>'s Terms and Conditions supersede all previous <?= get_option('company_name')  ?> Loyalty Terms and Conditions.</li>
                                    <li class="line-height30 arial-font">Under 18-year-old and players with multiple user IDs at <?= get_option('company_name')  ?> are not eligible.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to upgrade players based on <?= get_option('company_name')  ?> Reward Points. Players must meet tier upgrade point requirements and follow <?= get_option('company_name')  ?> terms and conditions.</li>
                                    <li class="line-height30 arial-font">Real-money wagers earn Reward Points. Bonus amounts used in games will not accumulate Reward Points. Reward Points are accumulated and updated between 12:00 PM and 1:00 PM GMT +6.</li>
                                    <li class="line-height30 arial-font">One Reward Points is earned by wagering BDT 50 on Slot and Fishing, BDT 200 on Live Casino games and BDT 100 on Table games, Arcade games and Card games.</li>
                                    <li class="line-height30 arial-font">Players can exchange Reward Points for cash based on their tier level. Reward Points are non-transferrable.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to modify, alter, discontinue, cancel, refuse, or void this <?= get_option('company_name')  ?> Loyalty at any time.</li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="spin_win_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Spin & Win</h6>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="page-banner-wrapper normal-width">
                            <div class="banner-image">
                                <img class="img-fluid rounded-3" src="https://betvisa-poster-s3.s3.ap-southeast-1.amazonaws.com/multicurrency-static-assets/en-BDT/banner-new/spin-win-mobile.jpg" alt="">
                            </div>
                        </div>
                        <div class="container mt-3">
                            <h6 class="default-title arial-font">Introduction</h6>
                            <p class="arial-font line-height30"><?= get_option('company_name')  ?> rewards players with free spins for achieving a simple goal or just playing daily games. Free spins can be used to win real cash, gift vouchers, and many other rewards.</p>
                        </div>
                        <div class="page-content container prize-table">
                            <h6 class="default-title">Prizes</h6>
                            <table class="default-table w-100">
                                <tbody class="without-head">
                                    <tr class="v-accent-bese rounded-3">
                                        <th class="w-50 py-3  ps-2">Daily prizes</th>
                                        <td class="w-50 py-3 ps-2">BDT 8,888</td>
                                    </tr>
                                    <tr class="rounded-3">
                                        <th class="w-50 py-3 ps-2">Free Credits</th>
                                        <td class="w-50 py-3 ps-2">BDT 100 – BDT 1,000</td>
                                    </tr>
                                    <tr class="v-accent-bese rounded-3">
                                        <th class="w-50 py-3 ps-2">Rewards Points</th>
                                        <td class="w-50 py-3 ps-2">18 – 5,000</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container default-box d-flex flex-column aling-items-center mt-3">
                                <div class="description d-flex flex-column align-items-center fs-16 arial-font">
                                    <span>Free Spins</span>
                                    <span>Win 8,888 Credits and more</span>
                                </div>
                                <button type="button" class="jwbtn w-75 py-4">
                                    Join Now
                                </button>
                            </div>
                        </div>
                        <div class="page-content container mt-3 free-spin-wrapper">
                            <h6 class="default-title ">Free Spins</h6>
                            <ul class="free-spin-box">
                                <li>
                                    <span>Completed 10,000 Turnover Per Day</span>
                                    <span>5 Tickets</span>
                                </li>
                                <li>
                                    <span>Completed 10,000 Deposit Per Day</span>
                                    <span>5 Tickets</span>
                                </li>
                                <li>
                                    <span>Extra Login Tickets (Deposit Player)</span>
                                    <span>Login On 9th, 19th And 29th And Every Tuesday</span>
                                </li>
                                <li>
                                    <span>Extra Deposit Tickets On Special Day</span>
                                    <span>Had Deposit On 9th, 19th And 29th And Every Tuesday</span>
                                </li>
                            </ul>
                        </div>
                        <div class="container terms-wrapper">
                            <h6 class="default-title">Terms and Conditions</h6>
                            <div class="terms-content">
                                <ol>
                                    <li class="line-height30 arial-font">Free spin tickets must be claimed from Spin and Win. Ticket claim issues should be reported by 23:59 pm (GMT+7) to Customer Support.</li>
                                    <li class="line-height30 arial-font">Tickets must be claimed within 24 hours of issuance or they will expire.</li>
                                    <li class="line-height30 arial-font">Promotion dates are from 00:00 am to 23:59 pm (GMT+7).</li>
                                    <li class="line-height30 arial-font">Players who meet the requirements must visit the Spin and Win page to redeem tickets.</li>
                                    <li class="line-height30 arial-font">Players can only have one account. Multiple or fraudulent accounts will be locked, and deposits forfeited.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to modify, alter, discontinue, cancel, refuse, or void Spin and Win at any time.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?>'s Terms and Conditions supersede all Spin and Win Terms and Conditions.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom h-92vh thme-white-black-bg" tabindex="-1" id="referral_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title text-center arial-font w-100 fw-bold thme-white-black-text" id="offcanvasBottomLabel">Referral</h6>
            <button type="button" class="btn " data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark thme-white-black-text"></i></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="page-banner-wrapper normal-width">
                            <div class="banner-image">
                                <img class="img-fluid rounded-3" src="https://betvisa-poster-s3.s3.ap-southeast-1.amazonaws.com/multicurrency-static-assets/en-BDT/banner-new/referral-mobile.jpg" alt="">
                            </div>
                        </div>
                        <div class="container mt-3">
                            <h6 class="default-title arial-font thme-white-black-text">Introduction</h6>
                            <p class="arial-font line-height30 thme-white-black-text">Invite your friends to <?= get_option('company_name')  ?> to get a 1-time referral bonus and unlimited daily rebate; your friend will receive a 1-time referral bonus.</p>
                        </div>
                        <div class="container">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/1.0264115.svg" alt="" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/1.0264115.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">1-time Referal Bonus</span>
                                                <span class="">Each of you gets BDT 300</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Invite your friend</span>
                                                        <span>Share your referral link</span>
                                                    </li>
                                                    <li>
                                                        <span>Your Friend make deposit</span>
                                                        <span>Deposit BDT 1,500 within 30days</span>
                                                    </li>
                                                    <li>
                                                        <span>Get BDT 300 Referral Bonus</span>
                                                        <span>For you and your friend</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/2.22f0339.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">Daily Rebate Bonus 0.3%</span>
                                                <span>From your friend’s daily turnover</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Total turnover of your friend</span>
                                                        <span>From games played by them</span>
                                                    </li>
                                                    <li>
                                                        <span>Daily Rebate Bonus</span>
                                                        <span>Earn from your friend’s turnover</span>
                                                    </li>
                                                    <li>
                                                        <span>Get BDT 300 Referral Bonus</span>
                                                        <span>For you and your friend</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/3.06995e3.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">Daily Rebate Bonus 0.05%</span>
                                                <span>From your friend’s referrals daily turnover</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Total turnover of your friend’s referral</span>
                                                        <span>From games played by them</span>
                                                    </li>
                                                    <li>
                                                        <span>Daily Rebate Bonus</span>
                                                        <span>Earn 0.05% from your friend’s referral turnover</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container terms-wrapper">
                            <h6 class="default-title thme-white-black-text">Terms and Conditions</h6>
                            <div class="terms-content">
                                <ol class="thme-white-black-text">
                                    <li class="line-height30 arial-font">Players must invite their friends using the referral link.</li>
                                    <li class="line-height30 arial-font">Once the referral bonus conditions are met, the bonus will be credited to the player and their referrals automatically.</li>
                                    <li class="line-height30 arial-font">Daily rebate commissions of 0.3% and 0.05% will automatically be credited after 13:00 pm (GMT+7).</li>
                                    <li class="line-height30 arial-font">Players can only have one account. Multiple or fraudulent accounts will be locked, and deposits forfeited.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to modify, alter, discontinue, cancel, refuse or void this promotion.</li>
                                    <li class="line-height30 arial-font">
                                    <?= get_option('company_name')  ?> <a href="#" class="fw-bold decoration-none">Terms and Conditions</a> apply.
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="responsible_gambling_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Responsible Gaming</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="container mt-3">
                            <h6 class="default-title">Age Requirement</h6>
                            <p class="arial-fon line-height30t"><?= get_option('company_name')  ?>'s customers must be 18 years of age or older and agree to abide by the terms and conditions set by the company.</p>
                            <h6 class="default-title">Forgot Your Username Or Password?</h6>
                            <p class="arial-font line-height30t">Customers can automatically link to online customer service by clicking 'Forgot Password'.
                                The 24-hour online customer service will provide you with a solution after passing a professional verification plan.
                            </p>
                            <h6 class="default-title">Steps To Deposit</h6>
                            <ol class="ps-3">
                                <li class="arial-font line-height30t"> Please click on 'deposit' at the top right of the homepage to enter the platform deposit page.</li>
                                <li class="arial-font line-height30t">After entering the amount you want to deposit, click 'Select Channel' on the right.
                                </li>
                                <li class="arial-font line-height30t">You can click below deposit channels. (The upper and lower limits of recharge are subject to the payment channel) </li>
                            </ol>
                            <h6 class="default-title">How To Withdraw Money</h6>
                            <p class="arial-font line-height30t">By clicking 'Withdraw' at the top right of the homepage, enter your withdrawal password and the amount you want to withdraw, and then click the withdrawal after completion.
                                For the first withdrawal, please bind the withdrawal bank card to the bank card message.
                                Withdrawal limit is ৳800, withdrawal limit is ৳30,000 per day
                            </p>
                            <h6 class="default-title">Personal Data Security
                            </h6>
                            <p class="arial-font line-height30t">The company will ensure that your personal information is not disclosed to any third party.
                                The company will also ensure the security of your personal information and ensure that your information is restricted to our company.</p>
                            <h6 class="default-title">Central Wallet</h6>
                            <p class="arial-font line-height30t">All deposited amount and bonus will be deposited into a single central wallet and bets can be placed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="faq_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">FAQ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="container">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <h6 class=" fw-bold">Age Requirement</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t"><?= get_option('company_name')  ?> customers must be 18 years of age or older and agree to abide by the terms and conditions set by the company. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <h6 class=" fw-bold">Forgot Your Username Or Password?</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t">Customers can automatically link to online customer service by clicking 'Forgot Password'.
                                                The 24-hour online customer service will provide you with a solution after passing a professional verification plan. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            <h6 class=" fw-bold">How To Deposit</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t">There are several ways to deposit the platform: bank transfer, DhaPay (h5, secured), DhaPay (h5, secured)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            <h6 class=" fw-bold">Steps To Deposit</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ol>
                                                <li class="arial-font line-height30t"> Please click on 'deposit' at the top right of the homepage to enter the platform deposit page.</li>
                                                <li class="arial-font line-height30t"> After entering the amount you want to deposit, click 'Select Channel' on the right.</li>
                                                <li class="arial-font line-height30t">You can click below deposit channels.
                                                    (The upper and lower limits of recharge are subject to the payment channel)
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                            <h6 class=" fw-bold">How To Withdraw Money</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t">By clicking 'Withdraw' at the top right of the homepage, enter your withdrawal password and the amount you want to withdraw, and then click the withdrawal after completion.
                                                For the first withdrawal, please bind the withdrawal bank card to the bank card message.
                                                Withdrawal limit is ৳800, withdrawal limit is ৳30,000 per day</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                            <h6 class=" fw-bold">Personal Data Security</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t">The company will ensure that your personal information is not disclosed to any third party.
                                                The company will also ensure the security of your personal information and ensure that your information is restricted to our company.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                            <h6 class=" fw-bold">Central Wallet</h6>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <p class="arial-font line-height30t">All deposited amount and bonus will be deposited into a single central wallet and bets can be placed.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="terms_condition_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Terms & Conditions</h6>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div>
                <div class="vip-page-wrapper">
                    <div class="mobile-vip-page-content">
                        <div class="container mt-3">
                            <p class="line-height30 arial-font">Please read the following terms and conditions carefully before using any <?= get_option('company_name')  ?> service. They are applicable to all customers or account holders ("you") with an account on the <?= get_option('company_name')  ?></p>
                        </div>
                        <div class="container">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/1.0264115.svg" alt="" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/1.0264115.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">1-time Referal Bonus</span>
                                                <span>Each of you gets BDT 300</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Invite your friend</span>
                                                        <span>Share your referral link</span>
                                                    </li>
                                                    <li>
                                                        <span>Your Friend make deposit</span>
                                                        <span>Deposit BDT 1,500 within 30days</span>
                                                    </li>
                                                    <li>
                                                        <span>Get BDT 300 Referral Bonus</span>
                                                        <span>For you and your friend</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/2.22f0339.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">Daily Rebate Bonus 0.3%</span>
                                                <span>From your friend’s daily turnover</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Total turnover of your friend</span>
                                                        <span>From games played by them</span>
                                                    </li>
                                                    <li>
                                                        <span>Daily Rebate Bonus</span>
                                                        <span>Earn from your friend’s turnover</span>
                                                    </li>
                                                    <li>
                                                        <span>Get BDT 300 Referral Bonus</span>
                                                        <span>For you and your friend</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item referral-bonus-wrapper">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed referral-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            <img class="w-45" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/3.06995e3.svg" lazy="loaded">
                                            <div class="header-title d-flex flex-column ">
                                                <span class="">Daily Rebate Bonus 0.05%</span>
                                                <span>From your friend’s referrals daily turnover</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="v-expansion-panel-content__wrap">
                                                <ol>
                                                    <li>
                                                        <span>Total turnover of your friend’s referral</span>
                                                        <span>From games played by them</span>
                                                    </li>
                                                    <li>
                                                        <span>Daily Rebate Bonus</span>
                                                        <span>Earn 0.05% from your friend’s referral turnover</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container terms-wrapper">
                            <h6 class="default-title">Terms and Conditions</h6>
                            <div class="terms-content">
                                <ol>
                                    <li class="line-height30 arial-font">Players must invite their friends using the referral link.</li>
                                    <li class="line-height30 arial-font">Once the referral bonus conditions are met, the bonus will be credited to the player and their referrals automatically.</li>
                                    <li class="line-height30 arial-font">Daily rebate commissions of 0.3% and 0.05% will automatically be credited after 13:00 pm (GMT+7).</li>
                                    <li class="line-height30 arial-font">Players can only have one account. Multiple or fraudulent accounts will be locked, and deposits forfeited.</li>
                                    <li class="line-height30 arial-font"><?= get_option('company_name')  ?> reserves the right to modify, alter, discontinue, cancel, refuse or void this promotion.</li>
                                    <li class="line-height30 arial-font">
                                    <?= get_option('company_name')  ?> <a href="#" class="fw-bold decoration-none">Terms and Conditions</a> apply.
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     var main_balence = $('#own_balance').text();
        //     $("#own_balance").each(function(i) {
        //         len = $(this).text().length;
        //         if (len > 3) {
        //             $(this).text($(this).text().toFixed(2) + '.');
        //         }
        //     });

        // })

        function like_search_game() {
            $('#seach_offcanvas').offcanvas('show');
        }

        function night_Day_mode() {
            document.body.classList.toggle('dark-theme');
            if (document.body.classList.contains('dark-theme')) {
                $('#theme_icons').removeClass('fa-moon');
                $('#theme_icons').addClass('fa-circle-half-stroke');
                $('#theme_icons').addClass('text-dark');
                $('#theme_icons').removeClass('text-light');
                $('.v-night-mode-btn').removeClass('bg-dark')
                $('.v-night-mode-btn').addClass('bg-light')
            } else {
                $('#theme_icons').addClass('fa-moon');
                $('#theme_icons').removeClass('fa-circle-half-stroke');
                $('.v-night-mode-btn').removeClass('bg-light')
                $('.v-night-mode-btn').addClass('bg-dark')
                $('#theme_icons').removeClass('text-dark');
                $('#theme_icons').addClass('text-light');
            }
        }
    </script>