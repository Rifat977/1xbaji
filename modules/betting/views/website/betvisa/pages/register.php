<!DOCTYPE html>
<html lang="en">
<?php $website =  $this->db->get_where(db_prefix() . 'website')->row() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/responsive.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/style.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/custom.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/all.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/fontawesome.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/css/bootstrap.min.css')  ?>">
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/jquery.min.js')  ?>"></script>
    <link rel="icon" type="image/x-icon" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/images/favicon.png')  ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-image: url('<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/') . ($website ? $website->website_bg_img : '') ?>');">
    <div class="register-sections m-auto mt-5">
        <div class="container mt-3">
            <div class="">
                <?php

                $info = get_IP_info();

                $country_api = '';
                $ip_country = '';

                if (isset($info->country)) {
                    $country_api = $info->country;
                    $ip_country = $info->query;
                }

                ?>

            </div>
            <div class="my-4 pb-5">
                <div class="m-auto px-3 py-5">
                    <form class="" id="add_user_form">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name="id" value="0">
                        <div class="row text-light fw-bold">
                            <div class="d-flex flex-column align-items-center justify-content-center mt-5 mb-4 mx-2">
                                <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'upload/website/' . $website->header_logo)  ?>" style="width: 150px;height: 35px;">
                                <div class="fw-bold text-dark">Welcome to best Online Casino!</div>
                            </div>
                            <div class="input-group mb-3 v-login-input-field mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="user_name" name="user_name" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="input-group input_solt mr-sm-2 v-login-input-field mb-3 mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control bg-transparent border-0 v-outline-remove" placeholder="Password" name="password" id="password">
                                <div class="input-group-prepend d-flex align-items-center justify-content-center">
                                    <div class="input-group-text bg-transparent border-0 fs-20 "><i class="fas fa-eye-slash" id="eye"></i></div>
                                </div>
                            </div>
                            <span id="passwordErr" class="text-danger"></span>
                            <div class="input-group input_solt mr-sm-2 v-login-input-field mb-3 mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control bg-transparent border-0 v-outline-remove" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                                <div class="input-group-prepend d-flex align-items-center justify-content-center">
                                    <div class="input-group-text bg-transparent border-0 fs-20 "><i class="fas fa-eye-slash" id="eye"></i></div>
                                </div>
                            </div>
                            <span id="confirm_passwordErr" class="text-danger"></span>
                            <div class="input-group mb-3 v-login-input-field position-relative mb-3 mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-regular fa-user"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="full_name" name="full_name" placeholder="Full Name" autocomplete="off">

                            </div>
                            <input type="hidden" class="form-control" value="<?= (isset($_GET['ref']) ? $_GET['ref'] : '') ?>" name="reference" id="reference">
                            <span id="nameErr" class="text-danger"></span>
                            <div class="input-group mb-3 v-login-input-field position-relative mb-3 mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-phone-volume"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="mobile" name="mobile" placeholder="Mobile Number" autocomplete="off">

                            </div>
                            <span id="mobileErr" class="text-danger"></span>
                            <div class="input-group mb-3 v-login-input-field position-relative mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-regular fa-envelope"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="user_email" name="user_email" placeholder="Email" autocomplete="off">

                            </div>
                            <span id="user_emailErr" class="text-danger"></span>
                            <div class="input-group mb-3 v-login-input-field position-relative mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-brands fa-stack-overflow"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="" name="" placeholder="Promo Code" autocomplete="off">
                            </div>
                            <div class="input-group mb-3 v-login-input-field position-relative mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-earth-americas"></i></span>
                                <select class="form-control selection_select2" name="country" onchange="get_currency(this.value)" id="country">
                                    <option value="">Select Country</option>
                                    <?php
                                    $country_list = $this->db->get(db_prefix() . 'countries')->result();
                                    $selected_id = -1;
                                    foreach ($country_list as $k => $v) {
                                        if ($v->short_name == $country_api) {
                                            $selected_id = $v->country_id;
                                        }
                                    ?>
                                        <option value="<?= $v->country_id ?>" data-subtext="<?= $v->calling_code ?>" <?= ($v->short_name == $country_api) ? 'selected' : '' ?>><?= $v->short_name ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <span id="countryErr" class="text-danger"></span>
                            <div class="input-group mb-3 v-login-input-field position-relative mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-dollar-sign"></i></i></span>
                                <select class="form-control" name="currency_id" id="currency_id">
                                    <option value="0">Select currency</option>
                                    <?php
                                    $currencies = $this->db->get(db_prefix() . 'currencies')->result();

                                    foreach ($currencies as $v) { ?>
                                        <option value="<?= $v->id ?>" <?= $selected_id == $v->country_id ? 'selected' : '' ?>><?= $v->name ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            
                            <!-- <div class="input-group mb-3 v-login-input-field position-relative mx-2">
                                <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-globe"></i></i></span>
                                <input type="text" class="form-control bg-transparent border-0 v-outline-remove" id="country_code" name="country_code" placeholder="Country Code" autocomplete="off">
                            </div>
                            <span id="country_codeErr" class="text-danger"></span> -->
                            <div class="form-check mb-3 mx-2">
                                <input class="form-check-input" type="checkbox" value="" id="policy_agree">
                                <label class="form-check-label fs-14 text-dark" for="policy_agree">
                                    I agree to Terms & Condition and Privacy Policy
                                </label>
                            </div>
                            <div class="text-center mb-3 v-registetion-btn">
                                <!-- <button class="btn fw-bold px-5 login-btn w-100" type="submit" disabled>Login</button> -->
                                <button class="btn fw-bold px-5 login-btn w-100" type="submit">Join Now</button>
                            </div>
                            <div class="text-center mb-3 v-registetion-btn">
                                <a class="btn registration-btn" href="<?= base_url('betting/login') ?>" class="text-decoration-none">Login</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/jquery.min.js')  ?>"></script>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/betvisa/assets/js/bootstrap-bundle.min.js')  ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.selection_select2').select2();
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
        // $('#country').change(function() {
        // 	$('#currencySelect').html('Choose currency as your country, other wise, your account will be banned.');

        // })

        $('#add_user_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('betting/insert_user') ?>",
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
                    } else if (data.success) {
                        window.location.href = '<?= base_url('betting/login') ?>';
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#country').change();
        });


        // $('#country').change(function(e) {
        //     e.preventDefault();
        //     var option = $('option:selected', this).attr('data-subtext');

        //     $('#country_code').val(option);

        //     console.log(option);
        // });
    </script>
    <script>
        function get_currency(id) {
            $.ajax({
                url: "<?= base_url('betting/Betting/get_country') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>',
                    "c_id": id,
                },
                success: function(data) {
                    if (data.return) {
                        //console.log(data.currency['id']);
                        $('#currency_id').val(data.currency['id']);
                    } else {
                        $('#currency_id').val('0');
                    }


                },
                error: function(data) {
                    // do something
                }
            });
        }
    </script>

</body>

</html>