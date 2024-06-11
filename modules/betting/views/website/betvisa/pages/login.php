<!DOCTYPE html>
<html lang="en">
<?php $website = $this->db->get(db_prefix() . 'website')->row(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Sports' ?? $title ?></title>
    <style>
        :root {
            --body: #eef6fb;
            --dark: #232020;
            --yellow: #ffc800;
            --nav-text: #ffffff73;
            --white: #fff;
            --tab-active: #ffc800;
            --light: #fff;
            --gold: rgb(255 224 167);
            --info: #0dcaf0;
        }
    </style>
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/style.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/custom.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/responsive.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/all.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/fontawesome.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/bootstrap.min.css')  ?>">
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/jquery.min.js')  ?>"></script>
    <link rel="icon" type="image/x-icon" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/images.jpeg')  ?>">
</head>

<body style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/') . ($website ? $website->website_bg_img : '') ?>'); background-size: 100% 100%; background-attachment:fixed; background-repeat: no-repeat;">
    <div class="body-content overflow-hidden">
        <div class="content h-100 p-0  bg-white">
            <div class="login-wrapper">
                <div class="text-end">
                    <a href="<?= base_url('betting') ?>" class="btn mt-3">
                        <i class="fa-solid fa-xmark fs-4"></i>
                    </a>
                </div>
                <div class="login-bottom bg-white p-5">
                    <div class=" mt-5">
                        <div class="d-flex flex-column align-items-center justify-content-center mt-5 mb-4">
                            <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>" style="width: 150px;height: 35px;">
                            <div class="fw-bold">Welcome Back, Good Luck !</div>
                        </div>
                        <!-- action="<?= base_url('betting/auth') ?>" method="post" -->
                        <form id="login_form">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="input-group mb-3 v-login-input-field">
                                <span class="input-group-text bg-transparent v-icon-login border-0"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="user_email" name="user_email" placeholder="User Name" autocomplete="off" required>
                            </div>

                            <div class="input-group mb-3 v-login-input-field">
                                <span class="input-group-text v-icon-login bg-transparent border-0"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control bg-transparent border-0 v-outline-remove " name="password" id="" placeholder="Password" required>
                            </div>
                            <!-- <div class="input-group mb-3 v-login-input-field">
                                <span class="input-group-text v-icon-login bg-transparent border-0"><i class="fa-solid fa-key"></i></span>
                                <input type="text" maxlength="4" class="form-control position-relative border-0 input_code bg-transparent v-outline-remove" id="" value="" placeholder="Verification" required>
                                <span class="show_verify_code"></span>
                            </div> -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label fs-14" for="rememberme">
                                        Remember Me
                                    </label>
                                </div>
                                <!-- <div>
                                    <a class="decoration-none text-dark fw-bold fs-14" href="#formget_offcanvas" data-bs-toggle="offcanvas">Forget password ?</a>
                                </div> -->

                            </div>

                            <div class="text-center mt-2 v-login-input-field">
                                <!-- <button class="btn fw-bold px-5 login-btn w-100" type="submit" disabled>Login</button> -->
                                <button class="btn fw-bold px-5 login-btn w-100" type="submit">Login</button>
                            </div>
                            <div class="text-center mt-2 v-login-input-field">
                                <a class="btn registration-btn" href="<?= base_url('betting/registration') ?>" class="text-decoration-none"> Register now !</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    <div class="offcanvas offcanvas-bottom w198 h-92vh bg-white" tabindex="-1" id="formget_offcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel"></h3>
            <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark text-dark me-2"></i></button>
        </div>
        <div class="offcanvas-body small">
            <div class=" mt-5">
                <div class="d-flex flex-column align-items-center justify-content-center mt-5 mb-4">
                    <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/sports/logo-light.105add0.svg')  ?>" style="width: 150px;height: 35px;">
                    <div class="fw-bold">Forgot Password ? Reset your password</div>
                </div>
                <!-- action="<?= base_url('betting/auth') ?>" method="post" -->
                <form id="">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <div class="input-group mb-3 v-login-input-field">
                        <span class="input-group-text bg-transparent v-icon-login border-0"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="" name="" placeholder="Pleace enter your username" autocomplete="off" required>
                    </div>

                    <div class="input-group mb-3 v-login-input-field d-flex align-items-center">
                        <span class="input-group-text v-icon-login bg-transparent border-0"><i class="fa-regular fa-comments"></i></span>
                        <select class="form-select bg-transparent border-0 v-outline-remove" name="" id="select_email_mobile">
                            <option value="1">Mobile Number</option>
                            <option value="2">Email Account</option>
                        </select>
                    </div>
                    <div>
                        <div class="input-group mb-3 v-login-input-field v-show-select1 d-none">
                            <span class="input-group-text bg-transparent v-icon-login border-0"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="" name="" placeholder="Pleace enter your username" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3 v-login-input-field v-show-select2 d-none">
                            <span class="input-group-text bg-transparent v-icon-login border-0"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="" name="" placeholder="Pleace enter your username" autocomplete="off" required>
                        </div>

                    </div>

                    <div class="text-center mt-2 v-login-input-field">
                        <!-- <button class="btn fw-bold px-5 login-btn w-100" type="submit" disabled>Login</button> -->
                        <button class="btn fw-bold px-5 login-btn w-100" type="submit">Submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom w198 brTse zIndex10 bg-dark " tabindex="-1" id="loginOffcanvas" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header bg-dark text-light brTse">
            <h3 class="offcanvas-title fw-bold m-auto text-warning pop-outin" id="offcanvasBottomLabel">Warning!</h3>
            <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body brTse small menu-bg">
            <p class="text-danger fs-3">Email and password must be correct.</p>
        </div>
    </div>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/js/bootstrap-bundle.min.js')  ?>"></script>

    <script>
        // $('#select_email_mobile').onchange(function() {
        //     var selecV = $(this).val();
        //     if (selecV == 1) {
        //         $('.v-show-select1').css('display', 'block !important');
        //     } else {
        //         $('.v-show-select2').css('display', 'block');
        //     }
        // })
        $(document).ready(function() {
            $('.v-outline-remove').focus(function() {
                $('.v-outline-remove').css('outline', 'none');
                $('.v-outline-remove').css('border', 'none');
                $(this).parent().css('border', '2px solid #ffdd00');
            })
            $('.v-outline-remove').blur(function() {
                $('.v-outline-remove').css('outline', 'none');
                $('.v-outline-remove').css('border', 'none');
                $(this).parent().css('border', '2px solid #f2f2f2');
            })

            var seq = (Math.floor(Math.random() * 10000) + 10000).toString().substring(1);
            $('.show_verify_code').text(seq);
        });
        // $('.input_code').keypress(function(event) {
        //     if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
        //         event.preventDefault();
        //     }
        // });

        // $('.input_code').keyup(function(e) {
        //     var code = $('.show_verify_code').text();
        //     var input_code = $('.input_code').val();
        //     if (code == input_code) {
        //         $('.login-btn').attr('disabled', false);
        //     } else {
        //         $('.login-btn').attr('disabled', true);
        //     }
        // });

        $('#login_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('betting/auth') ?>",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    if (data == 'error' || data == false) {
                         $('#loginOffcanvas').offcanvas('show');
                        //alert('Email and password must be correct.')
                    } else {
                        window.location.href = "<?= base_url('betting') ?>";
                    }
                }
            });
        });
    </script>

</body>

</html>