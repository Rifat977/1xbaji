<div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="profile_password_change" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Password Change</h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <div class="container">
                <form class="form-inline change-password-form">
                    <div class="mb-3">
                        <label class="" for="">Old Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" id="password">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="" for="">New Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" id="password">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="" for="">Comfirm Password</label>
                        <div class="input-group input_solt mr-sm-2">
                            <input type="password" class="form-control" id="password">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-eye-slash" id="eye"></i></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="changebtn">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#eye').click(function() {
            if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#password').attr('type', 'text');

            } else {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#password').attr('type', 'password');
            }
        });
    });
</script>