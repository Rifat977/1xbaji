<div class="container mt-3">
    <div id="promotions-tabs" class="tabs promotions-tabs game-promotions">
        <ul id="promotiion_tabs" class="nav d-flex promotions-toolbar-wrapper py-2" style="overflow:hidden;">
            <div class="swiper-container-tab ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide w-53 ms-4">
                        <li class="nav-item active">
                            <a class="nav-link first" href="#promotion1">
                                <span class="">All</span>

                            </a>
                        </li>
                    </div>
                    <!-- <div class="swiper-slide w-53 ms-4">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                                <span class="">Free</span>

                            </a>
                        </li>
                    </div>
                    <div class="swiper-slide w-112">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                                <span class="">Welcome</span>

                            </a>
                        </li>
                    </div>
                    <div class="swiper-slide w-112">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                                <span class="">Deposit</span>

                            </a>
                        </li>
                    </div>
                    <div class="swiper-slide w-112">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                                <span class="">Daily Rebate</span>

                            </a>
                        </li>
                    </div>
                    <div class="swiper-slide w-112">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                                <span class="">Event</i></span>

                            </a>
                        </li>
                    </div>
                    <div class="swiper-slide w-112">
                        <li class="nav-item">
                            <a class="nav-link " href="#promotion1">
                            </a>
                        </li>
                    </div> -->
                </div>
            </div>
        </ul> <!-- END tabs-nav -->

        <div id="tabs-content">
            <div id="promotion1" class="tab-content">
                <?php
                foreach ($this->db->get_where('tblbet_promotion', ['is_active' => 1])->result() as $key) { ?>
                    <div class="promotions-card-wrapper mt-3">
                        <div class="promotions-card">
                            <div class="promotions-image">
                                <img class="w-100 h-100" src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/promotion/' . $key->image) ?>" alt="">
                            </div>
                            <div class="promotions-content p-2 arial-font">
                                <h6 class="content-title fw-bold"><?= $key->title ?></h6>
                                <div class="content-detail">
                                    <p class="arial-font fs-14"><?= $key->details ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#promotiion_tabs li .first').addClass('menu-active');
        $('.tab-content').hide();
        $('.tab-content:first').show();


    });

    // Click function
    $('#promotiion_tabs li').click(function() {
        $('#promotiion_tabs li').removeClass('active');
        $('#promotiion_tabs li a').removeClass('menu-active');
        $(this).addClass('active');
        $('.tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        var fs = $(this).find('a').addClass('menu-active');
        $(activeTab).fadeIn();
        return false;
    });
</script>