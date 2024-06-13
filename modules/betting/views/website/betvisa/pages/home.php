<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->

<?php
$website =  $this->db->get_where(db_prefix() . 'website')->row();

// $slider = $this->db->get_where(db_prefix() . 'slider', ['staff_id' => get_staff_user_id(), 'status' => 1])->result();

$sl = [];

foreach ($slider as $key => $value) {
    array_push($sl, $value->image);
}

?>

<div class="swiper-container">
    <!-- swiper slides -->
    <div class="swiper-wrapper">
        <?php
        if (!empty($slider)) {
            foreach ($slider as $k => $s) {
                if ($s->status == 1) {
        ?>
                    <div class="swiper-slide">
                        <a href="<?= $s->slider_url ?>" class="">
                            <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/slider/' . $s->image)  ?>" alt="" class="img-responsive">
                        </a>
                    </div>
        <?php }
            }
        }
        ?>
    </div>
    <!-- !swiper slides -->

    <!-- next / prev arrows -->
    <div class="swiper-button-next w-10 h-25"></div>
    <div class="swiper-button-prev w-10 h-25">
        </>
    </div>
    <!-- !next / prev arrows -->

    <!-- pagination dots -->
    <div class="swiper-pagination"></div>
    <!-- !pagination dots -->
</div>

<!-- marquee -->
<?php
if (isset($website) && $website->marquee != '') { ?>
    <div class="d-flex m-2 rounded-pill me-2 tab-btn-bgsoft">
        <div class="px-3  fs-20">
            <i class="fa-solid fa-microphone"></i>
        </div>
        <div class="w-100">
            <marquee class="pe-3">
                <ul id="marquee" class="d-flex align-items-center pt-1" behavior="scroll" direction="up" scrolldelay="500">
                    <li class="marque-list">
                        <?= $website->marquee; ?>
                    </li>

                </ul>
            </marquee>
        </div>
    </div>
<?php } ?>
<?php
$this->db->group_by('provider_id');
$this->db->where('is_active', 1);
$cats = $this->db->get('tblbet_provider')->result();
$type = $this->db->order_by('order_by')->get_where('tblbet_game_type', ['is_active' => 1])->result();
?>


<div id="menu-tabs" class="tabs menu-tabs game-mobile-menu">
    <nav>
        <div class="nav nav-tabs mb-3 game-mobile-menu-btn border-0" id="nav-tab" role="tablist">
            <div class="swiper-container-tab">
                <div class="swiper-wrapper v-home-slider-menu-tabs">
                    <div class="swiper-slide w-80">
                        <button class="nav-link active p-0 btn" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            <div class="v-tab-logo-hover">
                                <img class="v-tab-icon" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/mobile-tabs/btn-img/hot_game_hover.png') ?>" alt="">

                            </div>
                            <span class="tab-menu-name">Hot</span>
                        </button>
                    </div>
                    <?php foreach ($type as $key => $value) { ?>
                        <div class="swiper-slide w-80">
                            <button class="nav-link p-0 btn" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile<?= $value->type_id ?>" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                <div class="v-tab-logo-hover">
                                    <img class="v-tab-icon" src="<?= base_url('modules/betting/upload/game-type/' . $value->type_image) ?>" alt="">
                                </div>
                                <span class="tab-menu-name"><?= $value->type_name ?></span>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    
 
    <div class="tab-content p-3 border thme-white-black-bg border-0 tab_buttion" id="nav-tabContent">
        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row ful-casino-items">
                <?php foreach ($this->db->get_where('tblbet_game_list', ['is_hot' => 1])->result() as $key => $value) { ?>
                    <div class="col-6 p-1">
                        <div class="tabs-items-bg position-relative">
                            <a href="#" data-bs-toggle="offcanvas" onclick="play_game(<?= $value->game_type ?>,<?= $value->provider_id ?>,'<?= $value->game_code ?>')" class="d-block position-relative" style="width: 100%; height: 100%;">
                                <img class="w-100 h-100" src="<?= $value->image_url ?>" alt="<?= $value->game_name ?>" style="object-fit: cover;">
                                <div class="position-absolute bottom-0 start-0 w-100 px-2 py-1 text-light" style="background: linear-gradient(0deg, #000, #00000014);">
                                    <div class="fw-bold"><?= $value->game_name ?></div>
                                    <div class="text-danger fs-5"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php foreach ($type as $key => $value) { ?>
            <div class="tab-pane fade" id="nav-profile<?= $value->type_id ?>" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row ful-casino-items">
                    <?php $this->db->where('is_active', 1);
                    $providers = $this->db->get_where('tblbet_provider', ['provider_type' => $value->type_id])->result();
                    if ($providers) {
                        foreach ($providers as $provider) {
                    ?>
                            <div class="col-6 p-1">
                                <div class="tabs-items-bg">
                                    <a href="#" onclick="provider_game(<?= $provider->provider_id ?>,<?= $value->type_id ?>,'<?= $provider->provider_name ?>')" data-bs-toggle="offcanvas">
                                        <img class="w-100 h-100" src="<?= ($provider->provider_image != '' && $provider->provider_image != 'null') ? base_url('modules/betting/upload/game-type/' . $provider->provider_image) : module_dir_url(BETTING_MODULE_NAME, '/views/website/betvisa/assets/ssss.jpg') ?>" alt="">
                                        <div class="position-absolute px-2 py-1 bottom-0 left-0 w-100 d-flex justify-content-between" style="background: linear-gradient(0deg,#000,#00000014);">
                                            <div class="text-light fw-bold"><?= $provider->provider_name ?></div>
                                            <div class="text-danger fs-5"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="ambassador-image default-center">
        <img class="w-100" alt="Cesc Fàbregas" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/rrrr.png') ?>">
    </div>
</div>

<div class="container">
    <div class="about-wrapper">
        <h6 class="default-title thme-white-black-text">About <?= get_option('company_name')  ?></h6>
        <p class="arial-font thme-white-black-text"><?= get_option('company_name')  ?> was established in 2017 and&nbsp;operated under a Curacao gaming license&nbsp;with more than 2 million users. One of top&nbsp;Asia's most trusted and leading online casinos and sports betting platforms. <?= get_option('company_name')  ?> offers a wide selection of slot games, live&nbsp;casinos, lotteries, sportsbooks, sports&nbsp;exchanges, and e-sports. Offers you a variety&nbsp;of secure and easy payment methods along&nbsp;with 24-hour friendly live customer support to&nbsp;ensure that any queries are dealt with and&nbsp;resolved quickly.</p>
    </div>
    <div class="payment-partner-wrapper">
        <h6 class="default-title thme-white-black-text">Payment Methods</h6>
        <div class="method-list">
            <div class="method"><img class="w-100" alt="bkash" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/footer-payment-bkash.f086c33.svg" lazy="loaded"></div>
            <div class="method"><img class="w-100" alt="nagad" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/footer-payment-nagad.6780d47.svg" lazy="loaded"></div>
            <div class="method"><img class="w-100" alt="rocket" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/footer-payment-rocket.5cd0b37.svg" lazy="loaded"></div>
            <div class="method"><img class="w-100" alt="astropay" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/footer-payment-astropay.60088e0.svg" lazy="loaded"></div>
            <div class="method"><img class="w-100" alt="usdt" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/footer-payment-usdt.bc599a3.svg" lazy="loaded"></div>
        </div>
    </div>
    <div class="social-links-wrapper mt-3">
        <h6 class="default-title thme-white-black-text">Follow Us</h6>
        <div class="menu-social-icons d-flex">
            <a href="https://www.facebook.com/" target="_blank" class="menu-social-facebook me-1 thme-white-black-text">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.whateapps.com/" target="_blank" class="menu-social-whatsapp me-1 thme-white-black-text">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="menu-social-instagram me-1 thme-white-black-text">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.email.com/" target="_blank" class="menu-social-email me-1 thme-white-black-text">
                <i class="fa-regular fa-envelope"></i>
            </a>

            <a href="https://www.telegram.com/" target="_blank" class="menu-social-telegram me-1 thme-white-black-text">
                <i class="fa-brands fa-telegram"></i>
            </a>
            <a href="https://www.twitter.com/" target="_blank" class="menu-social-twitter me-1 thme-white-black-text">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </div>
    </div>
    <div class="licenses-wrapper mt-3">
        <h6 class="default-title thme-white-black-text">Licenses</h6>
        <div class="licenses-list d-flex gap-1">
            <div class="image-wrapper"><img alt="gc" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.79/img/gc.f267a07.svg" lazy="loaded"></div>
            <div class="image-wrapper"><img alt="18" src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0My45NCA0My45NCI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNkOTRhMzc7fTwvc3R5bGU+PC9kZWZzPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTM0LjcyLDMxLjdsMS44MiwxLjQ3YTE5Ljk0LDE5Ljk0LDAsMSwxLDEtMjAuNzlsLTIsMS4xN2ExNy42MiwxNy42MiwwLDEsMC0uOCwxOC4xNVptNC41Ny0xMC42M1YxNi41M0gzNi4yM3Y0LjU0SDMxLjd2My4wNmg0LjUzdjQuNTNoMy4wNlYyNC4xM2g0LjU0VjIxLjA3Wk0xNC44NCwzMC44OVYxNC4yNGgtNWwtMS4xOCwxdjIuNjJoMi4zOHYxM1ptNC44NC05LjFhNC40MSw0LjQxLDAsMCwxLTEuOTQtMy41M2MwLTIuNjQsMi42NC00Ljc3LDUuODktNC43N3M1Ljg5LDIuMTMsNS44OSw0Ljc3YTQuMzgsNC4zOCwwLDAsMS0xLjk0LDMuNTMsNS4xMSw1LjExLDAsMCwxLDIuNjgsNC4zMWMwLDMtMyw1LjM3LTYuNjMsNS4zN1MxNywyOS4wNywxNywyNi4xQTUuMTMsNS4xMywwLDAsMSwxOS42OCwyMS43OVptMS40Ni0zLjUzYTIuMjksMi4yOSwwLDAsMCwyLjQ5LDIsMi4zLDIuMywwLDAsMCwyLjUtMiwyLjMsMi4zLDAsMCwwLTIuNS0yQTIuMjksMi4yOSwwLDAsMCwyMS4xNCwxOC4yNlptLS4zMSw3Ljg0YTIuNTcsMi41NywwLDAsMCwyLjgsMi4yNywyLjU4LDIuNTgsMCwwLDAsMi44MS0yLjI3LDIuNTksMi41OSwwLDAsMC0yLjgxLTIuMjdBMi41OCwyLjU4LDAsMCwwLDIwLjgzLDI2LjFaIi8+PC9zdmc+" lazy="loaded"></div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-bottom h-92vh default-offcanvas" tabindex="-1" id="sub_mobile_game_offcanvas" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="bg-transparent border-0 fs-5 thme-white-black" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-arrow-left"></i></button>
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="provider_name"></h6>
    </div>
    <div class="offcanvas-body small">
        <div class="row">
            <div id="show_game" class="row"></div>

        </div>
    </div>
</div>





<script>

</script>

<script>
    $(document).ready(function() {
        $('#tabs-nav li .first').addClass('menu-active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // get_sports();
    });
    // Click function

    $('.v-home-slider-menu-tabs button').click(function() {
        $('.v-home-slider-menu-tabs button').removeClass('active');
        $(this).addClass('active');

    })



    function provider_game(p_id, t_id, name) {
        if (1) {
            play_game(t_id, p_id, false);
        } else {

            $.ajax({
                type: "get",
                url: "<?= base_url('betting/Betting/get_provider_game/') ?>" + p_id + '/' + t_id,
                dataType: "json",
                success: function(data) {
                    var html = '';
                    console.log(data);
                    if (data != [] && data != '' && data != null) {
                        $('#sub_mobile_game_offcanvas').offcanvas('show');

                        $.each(data, function(index, value) {
                            html += `<div class="col-6 mb-3">
                                <div class="tabs-items-bg position-relative">
                                    <a href="#" onclick="play_game(${value.game_type},${ value.provider_id},'${value.game_code}')" class="">
                                        <img class="w-100 h-100 rounded-3 " src="${(value.image_url!='')?value.image_url:'<?= module_dir_url(BETTING_MODULE_NAME, '/views/website/betvisa/assets/ssss.jpg')  ?>'}" alt="">
                                        <div class="position-absolute px-2 py-1 bottom-0 left-0 w-100 d-flex justify-content-between" style="background: linear-gradient(0deg,#000,#00000014);">
                                            <div class="text-light fw-bold">${value.game_name}</div>
                                            <div class="text-danger fs-5"><i class="fa-solid fa-heart"></i></div>
                                        </div>
                                    </a>
                                </div>
                            </div>`;
                        });
                        $('#show_game').html(html);
                        $('#provider_name').html(name);
                        // $('#provider_' + p_id + '_' + t_id).hide();
                        // $('#play_' + p_id + '_' + t_id).show()
                    } else {
                        alert('Game Not found');
                    }
                }

            });
        }
        // var data = <?= json_encode($this->db->select('provider_id')->where('is_active', 1)->get('tblbet_provider')->result()) ?>;

        // data.forEach(e => {
        //     $("#provider_" + e.provider_id + "_" + t_id).hide();

        // });
    }
    // p_id1 = p_id;
    // t_id1 = t_id;


    function play_game(type, provider, game) {
        // console.log(type, provider, game);
        $.ajax({
            url: "<?= base_url('betting/Betting/launch_game') ?>",
            type: "POST",
            dataType: "json",
            data: {
                '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>',
                "type_id": type,
                "provider_id": provider,
                "game_id": game
            },
            success: function(data) {
                if (data.return) {
                    if (data.url.status == false) {
                        alert(data.url.message);
                        //console.log(data.url.message);
                    } else {
                        $(".preloader").fadeOut(1000);
                        $('#preloader').show();
                        if (data.url.data) {
                            window.location.href = data.url.data;
                        }
                    }
                } else {
                    $(window).attr('location', '<?= base_url('betting/login') ?>');
                }
            },
            error: function(data) {
                // do something
            }
        });

    }
    // function login() {
    //     $(window).attr('location','http://valkey.apitsoft.com/betting/login');
    // }
    function transfer_slider(id) {
        $('.swiper-slide .nav-link').removeClass('active');
        $('button[data-bs-target="#nav-profile' + id + '"]').addClass('active')
        $('.tab-pane').removeClass('active');
        $('.tab-pane').removeClass('show');
        $('#nav-profile' + id).addClass('active');
        $('#nav-profile' + id).addClass('show');
        $('#offcanvasExample').offcanvas('hide');


    }
</script>