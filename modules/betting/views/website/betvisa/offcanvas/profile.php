<?php !empty($this->session->userdata('logged_in')) ? $user = $this->db->get_where(db_prefix() . 'user', ['id' => $_SESSION['logged_in']->id])->row() : '' ?>

<div class="offcanvas offcanvas-bottom h-92vh bg-white" tabindex="-1" id="profiles" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header tab-btn-bgsoft text-light text-center">
        <div class="offcanvas-title " id="offcanvasBottomLabel">
            <div class="d-flex align-items-center">
                <div><i class="fa-regular fa-user fs-18 border border-2 boder-secondary rounded-pill p-2"></i></div>
                <div class="d-flex flex-column fs-14 ms-2">
                    <span>Hellow,</span>
                    <span>Simul H</span>
                </div>
            </div>
        </div>

        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark text-dark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <!-- <section class="bg-light br5 fs-16">
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Affiliate Id</div>
                <div class="p-2"><?= isset($user) ? $user->id : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">User Id</div>
                <div class="p-2"> USR-<?= isset($user) ? $user->id : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Name</div>
                <div class="p-2"><?= isset($user) ? $user->full_name : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Email</div>
                <div class="p-2"><?= isset($user) ? $user->user_email : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Country Code</div>
                <div class="p-2"><?= isset($user) ? $user->country_code : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Contact Number</div>
                <div class="p-2"><?= isset($user) ? $user->mobile : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Currency</div>
                <div class="p-2"><?= isset($user) ? $this->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row()->name ?? '' : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Country</div>
                <div class="p-2"><?= isset($user) ? ($this->db->get_where(db_prefix() . 'countries', ['country_id' => $user->country])->row()->short_name ?? '') : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Address</div>
                <div class="p-2"><?= isset($user) ? $user->address : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">City</div>
                <div class="p-2"><?= isset($user) ? $user->city : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Zip Code</div>
                <div class="p-2"><?= isset($user) ? $user->zip : '' ?></div>
            </div>
            <div class="d-flex border-bottom2">
                <div class="w-140 p-2 ps-3">Reference</div>
                <div class="p-2"><?= isset($user) ? $user->reference : '' ?></div>
            </div>
            <?php if (isset($user)) { ?>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="w-140 p-2 ps-3">Password</div>
                        <div class="p-2 password d-flex">
                            <input type="password" value="<?= isset($user) ? $user->password_text : '' ?>" class="form-control border-0 bg-light" id="show_password">
                            <span class="btn"><i class="fa-solid fa-eye toggle-password d-inline-block" toggle="#show_password"></i></span>
                        </div>
                    </div>
                    <div class="float-end pt-2 pe-4">
                        <a class="bg-warning text-dark py-1 mt-1 px-3 text-decoration-none" data-bs-toggle="offcanvas" href="#profiles_edit" role="bottom">Edit</a>
                    </div>
                </div>
            <?php } ?>
        </section> -->
        <div cla></div>
    </div>
</div>



<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="profiles_edit" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header text-dark text-center">
        <a class="btn outline bg-light border-radius-5" href="<?= base_url('betting') ?>"><i class="fa-solid fa-angle-left"></i></a>
        <div class="m-auto">
            <!-- <img class="h-60" src="<?= base_url('assets/images/velki-logo.webp') ?>"> -->
        </div>
    </div>
    <div class="offcanvas-body small p-0 bg-light brTse">
        <section class="text-dark w-75 m-auto">
            <form class="text-center pt-4 pb-3" id="change_password_form">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <h2 class="text-center mb-3 fw-bold">Change Password</h2>
                <div class="form-group mb-3 text-start fs-16">
                    <label class="control-label">Your Password</label>
                    <div class="">
                        <input id="old-password-field" type="password" class="form-control outline" name="old_password" value="">
                        <span toggle="#old-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <span id="old_passwordErr"></span>
                </div>

                <div class="form-group mb-3 text-start fs-16">
                    <label class="control-label">New Password</label>
                    <div class="">
                        <input id="npassword-field" type="password" class="form-control outline" name="password" value="">
                        <span toggle="#npassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <span id="passwordErr"></span>
                </div>
                <div class="form-group mb-3 text-start fs-16">
                    <label class="control-label">Confirm Password</label>
                    <div class="">
                        <input id="cpassword-field" type="password" class="form-control outline" name="confirm_password" value="">
                        <span toggle="#cpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <span id="confirm_passwordErr"></span>
                </div>
                <button class="text-center w-50 fw-bold bg-warning py-1 fs-5 outline br5" type="submit">Change</button>
            </form>
            <ul class="fs-16 p-0 pt-5">
                <li> Password must have 8 to 15 alphanumeric without white space</li>
                <li> Password cannot be the same as username / nickname</li>
                <li> Must contain at least 1 capital letter, 1 small letter and 1 number</li>
                <li> Password must not contain any special characters (!,@,#,etc..)</li>
            </ul>
        </section>
    </div>
</div>
<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


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