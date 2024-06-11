<?php $website =  $this->db->get_where(db_prefix() . 'website')->row(); ?>

<div class="offcanvas offcanvas-start w-100 h-92vh body-mid" tabindex="-1" id="menu_betvisa_offcanvas" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header text-light py-1 mb-3 header-mid">
        <div class="d-flex justify-content-between w-100 align-items-center">
            <div class="offcanvas-title d-flex justify-content-between align-items-center w-100 me-3" id="offcanvasBottomLabel">
                <a href="#"><img style="width: 150px;height:60px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>"></a>
                <a class="d-flex sideber_menu_home " href="<?= base_url() ?>">
                    <i class="fa-solid fa-home me-2"></i>
                    <div class="text-light">Home</div>
                </a>
            </div>
            <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <div class="offcanvas-body small">
        <div>
            <div>
                <div class="w-100 bg_refer mx-2">
                    <a class="sidebar_button " href="#">
                        <img class="header_icon_referral_light" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/mobile-tabs/menu/icon-referral-light.png') ?>" alt="">
                        <img style="width: 22px;" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/mobile-tabs/menu/icon-referral.svg') ?>" alt="">
                        <div class="texts-sm text-white ms-3">Refer And Earn</div>
                    </a>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="w-50 bg_lucky_spin mx-2">
                        <a class="sidebar_button " href="#">
                            <img style="width: 22px;" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/mobile-tabs/menu/Untitled.png') ?>" alt="">
                            <div class="texts-sm text-white ms-3">Refer And Earn</div>
                        </a>
                    </div>
                    <div class="w-50 bg_mission mx-2">
                        <a class="sidebar_button " href="#">
                            <img style="width: 22px;" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/mobile-tabs/menu/icon-mission.png') ?>" alt="">
                            <div class="texts-sm text-white ms-3">Mission Diary</div>
                        </a>
                    </div>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class=" " href="#deposit_log" data-bs-toggle="offcanvas">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <div class="texts-sm text-white ms-3">Deposit Log</div>
                    </a>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class=" " href="#withdraw_log" data-bs-toggle="offcanvas">
                        <i class="fa-solid fa-money-bill-1"></i>
                        <div class="texts-sm text-white ms-3">Withdraw Log</div>
                    </a>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class=" " href="#affiliate" data-bs-toggle="offcanvas">
                        <i class="fa-solid fa-users"></i>
                        <div class="texts-sm text-white ms-3">Affiliate</div>
                    </a>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class=" " href="#bets_history" data-bs-toggle="offcanvas">
                        <i class="fa-solid fa-circle-info"></i>
                        <div class="texts-sm text-white ms-3">Bet history</div>
                    </a>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class=" " href="#">
                        <i class="fa-solid fa-headset"></i>
                        <div class="texts-sm text-white ms-3">Contact Us</div>
                    </a>
                </div>
                <div class="w-100 bg_refer_hover mx-2 mt-2">
                    <a class="" href="<?= base_url('betting/desk_logout') ?>">
                        <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                        <div class="texts-sm ms-3 text-danger">Log Out</div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.casino_menu_mobaile  a').click(function() {
            $('a').removeClass("active");
            $(this).addClass("active");
            // $('.active').css('color', 'green')
        });
    });

    $('.casino_menu_mobaile a').click(function() {
        $('#menu_offcanvas').offcanvas('hide');
        var hash = window.location.hash;
        console.log(hash);
        $('.tabs-btn-hov').removeClass('active');
        $('.tab-content2 .tab-pane').removeClass('active show');
        $(hash + '-tab').addClass('active');
        $(hash).addClass('active show');
    })

    function bottom_menu() {
        var hash = window.location.hash;
        $('.tabs-btn-hov').removeClass('active');
        $('.tab-content2 .tab-pane').removeClass('active show');
        $('#' + window.location.hash + '-tab').addClass('active');
        $('#' + window.location.hash).addClass('active show');
    }
</script>