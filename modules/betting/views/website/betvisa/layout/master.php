<!DOCTYPE html>
<html lang="en">
<?php $website =  $this->db->get_where(db_prefix() . 'website')->row() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?= 'Sports' ?? $title ?></title> -->
    <title><?= get_option('company_name')  ?></title>
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/style.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/custom.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/all.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/fontawesome.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/bootstrap.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/swiper.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/daterangepicker.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/responsive.css')  ?>">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/favicon.png')  ?>">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/jquery.min.js')  ?>"></script>


    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/moment.min.js')  ?>"></script>

    <?php
    if ($this->uri->segment(2) != 'match_detail') {
        // echo '<script src="' . module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/jquery.daterangepicker.min.js') . '"></script>';
    }

    ?>

</head>

<body style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/bangladesh-cricket-team-green-poster-3532ukxu2ppipg3d.jpg')  ?>'); background-size: 100% 100%;background-attachment:fixed; background-repeat: no-repeat;">
    
    <div id="preloader">
        <div class="preloader-content">
            <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/fab_icon.png')  ?>" alt="Logo">
        </div>
    </div>
    
    <div class="body-content overflow-hidden">
        <div class="content" style="overflow-x: hidden !important;">
            <?php $this->load->view('website/' . $this->theme . '/layout/header') ?>

            <?php $this->load->view($body) ?>
            <?php
            if (isset($footer)) {
                if (isset($website) && $website->footer_status == 1) {
                    $this->load->view('website/' . $this->theme . '/layout/footer');
                }
            }
            ?>
        </div>
        <?php
        if (isset($footer_bottom)) {
            $this->load->view($footer_bottom);
        }
        ?>
    </div>


    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/balance') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/profile') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/withdraw_log') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/withdraw') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/active_log') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/current_bets') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/bets_history') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/settings') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/deposit_log') ?>
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/affiliate') ?>
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/affiliate_withdraw') ?>
    <?php //$this->load->view('website/' . $this->theme . '/offcanvas/vip') ?>



    <!-- new offcanvas  -->
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/banks') ?>
    <!-- </?php $this->load->view('website/' . $this->theme . '/offcanvas/new/wallet') ?> -->
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/new/profile') ?>
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/new/menu') ?>
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/new/password-change') ?>
    <?php $this->load->view('website/' . $this->theme . '/offcanvas/new/bank-off') ?>

    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/swiper.min.js')  ?>"></script>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/swiper.js')  ?>"></script>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/swiper-tab.js')  ?>"></script>




    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/bootstrap-bundle.min.js')  ?>"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->




    <script>
        tabWrapper.on('click', '.services-tabs', function(event) {
            $('.services-tabs').removeClass('selected');
            $(this).addClass('selected');
            console.log(this.element);
        });


        jQuery(function($) {
            $.fn.hScroll = function(amount) {
                amount = amount || 120;
                $(this).bind("DOMMouseScroll mousewheel", function(event) {
                    var oEvent = event.originalEvent,
                        direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
                        position = $(this).scrollLeft();
                    position += direction > 0 ? -amount : amount;
                    $(this).scrollLeft(position);
                    event.preventDefault();
                })
            };
        });

        $(document).ready(function() {
            $('#mn-pills-tab, #j-pills-tab, #v-pills-tab, .casinos-perent, .sports_header_tabs, .hscroll').hScroll(40); // You can pass (optionally) scrolling amount
        });

        function depositLoad() {
            $.ajax({
                type: "post",
                url: "<? admin_url('betting/admin/deposit_veiw') ?>",
                dataType: "json",
                success: function(data) {

                }
            });
        }


        function refresh_balance(user_id) {
            $.ajax({
                type: "post",
                url: "<?= base_url('betting/refresh_balance/') ?>" + user_id,
                data: {
                    '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
                },
                dataType: "json",
                success: function(balance) {
                    $('#own_balance').html(balance);
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var preloader = document.getElementById('preloader');
                preloader.style.display = 'none';
                
                var mainContent = document.getElementById('main-content');
                mainContent.style.display = 'block';
            }, 3000); 
        });

    </script>



</body>

</html>