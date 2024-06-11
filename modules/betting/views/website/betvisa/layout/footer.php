<?php $website =  $this->db->get_where(db_prefix() . 'website')->row() ?>

<!-- <footer class="mt-5">
    <?php
    if (isset($website) && $website->apk_link != '') { ?>
        <div class="flex justify-center items-center flex-col text-center mt-40px"><a class="inline-block mb-1" href="<?= isset($website) ? $website->apk_link : '' ?>" target="_blank">
                <img width="140" height="41" class="w-120px h-auto mx-auto" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/') ?>images/btn-android-dl.webp"></a><br>
            <span class="text-11 text-black-600">v1.11 - 2022/3/8 - 2.6MB</span>
            <p class="test-app"></p>
        </div>
    <?php }
    ?>

    <div class="social d-flex justify-content-center">
        <?php
        if (isset($website) && $website->social_icon_1_link != '') { ?>
            <a href="<?= isset($website) ? $website->social_icon_1_link : '#' ?>" target="_blank" class="block cursor-pointer mx-1 footer-icon"><?= isset($website) ? $website->social_icon_1 : '' ?></span></a>
        <?php }
        if (isset($website) && $website->social_icon_2_link != '') {
        ?>
            <a href="<?= isset($website) ? $website->social_icon_2_link : '#' ?>" target="_blank" class="block cursor-pointer mx-1 footer-icon"><?= isset($website) ? $website->social_icon_2 : '' ?></a>
        <?php }
        if (isset($website) && $website->social_icon_3_link != '') {
        ?>
            <a href="<?= isset($website) ? $website->social_icon_3_link : '#' ?>" target="_blank" class="block cursor-pointer mx-1 footer-icon"><?= isset($website) ? $website->social_icon_3 : '' ?></a>
        <?php } ?>
    </div>

    <div class="footer-menu footer-canvas p-5">
        <div class="child">
            <a data-bs-toggle="offcanvas" href="#offcanvasFooter1" role="button" aria-controls="offcanvasFooter1" onclick="footer_canvas('<?= isset($website) ? $website->footer1_details : '' ?>')">
                <?= isset($website) ? $website->footer1 : '' ?>
            </a>
            <a data-bs-toggle="offcanvas" href="#offcanvasFooter1" role="button" aria-controls="offcanvasFooter2" onclick="footer_canvas('<?= isset($website) ? $website->footer2_details : '' ?>')">
                <?= isset($website) ? $website->footer2 : '' ?>
            </a>
            <a data-bs-toggle="offcanvas" href="#offcanvasFooter1" role="button" aria-controls="offcanvasFooter3" onclick="footer_canvas('<?= isset($website) ? $website->footer3_details : '' ?>')">
                <?= isset($website) ? $website->footer3 : '' ?>
            </a>
            <a data-bs-toggle="offcanvas" href="#offcanvasFooter1" role="button" aria-controls="offcanvasFooter4" onclick="footer_canvas('<?= isset($website) ? $website->footer4_details : '' ?>')">
                <?= isset($website) ? $website->footer4 : '' ?>
            </a>
            <a data-bs-toggle="offcanvas" href="#offcanvasFooter1" role="button" aria-controls="offcanvasFooter5" style="border-right: none;" onclick="footer_canvas('<?= isset($website) ? $website->footer5_details : '' ?>')">
                <?= isset($website) ? $website->footer5 : '' ?>
            </a>
        </div>
    </div>
</footer> -->
<div class="fsdfsdfsf">
    <div class="py-2 ">
        <div class="bottom_menu_off0">
            <ul class="d-flex justify-content-around align-items-center text-center p-0 mb-0">
                <li>
                    <a href="<?= base_url() ?>">
                        <i class="fa-solid fa-house"></i>
                        <p class="mb-0">Home</p>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('betting/promotions') ?>">
                        <i class="fa-solid fa-gift"></i>
                        <p class="mb-0">Promotion</p>
                    </a>
                </li>
                <li>

                    <a href="<?= (!is_null($this->session->userdata('logged_in'))) ? base_url('betting/deposit_widthraw') : base_url('betting/login') ?>">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <p class="mb-0">Deposit</p>
                    </a>
                </li>
                <li>
                    <a href="<?= (!is_null($this->session->userdata('logged_in'))) ? 'https://direct.lc.chat/10817422/207' : base_url('betting/login') ?>">
                        <i class="fa-solid fa-headset"></i>
                        <p class="mb-0">Support</p>
                    </a>
                </li>
                <li>
                    <a role="button" href="<?= (!is_null($this->session->userdata('logged_in'))) ? base_url('betting/account') : base_url('betting/login') ?>">
                        <i class="fa-solid fa-user"></i>
                        <p class="mb-0">Account</p>
                    </a>
                </li>
            </ul>

        </div>
    </div>

</div>
<?php $this->load->view('website/' . $this->theme . '/offcanvas/footer_canvas') ?>

<script>
    function footer_canvas(details) {
        $('#footer_details_div').empty();
        $('#footer_details_div').html(details);

    }
</script>