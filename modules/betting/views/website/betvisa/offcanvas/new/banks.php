<div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="bank_oplo" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-center" id="offcanvasBottomLabel">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div class="account-mobile-view-wrapper">
            <div class="profile-wrapper">
                <div class="item">
                    <span class="label">Full Name</span>
                    <span class="value">Simul H</span>
                </div>
                <div class="item">
                    <span class="label">Username</span>
                    <span class="value">simulh1234</span>
                </div>
                <div class="item">
                    <span class="label">Email</span>
                    <span class="value">simul@gmail.com</span>
                </div>
                <div class="item">
                    <span class="label">Mobile</span>
                    <span class="value">
                        <span>01738026336</span>
                        <button type="button" class="btn rounded-pill bg-suc ms-3" onclick="mobile_modal()" style="padding:0px 6px">
                            <i class="fa-solid fa-plus text-light fs-12 "></i>
                        </button>
                    </span>
                </div>
                <div class="item">
                    <span class="label">D.O.B</span>
                    <span class="value">
                        <button type="button" class="btn rounded-pill ms-3 bg-suc " onclick="mobile_dob()" style="padding:0px 6px">
                            <i class="fa-solid fa-plus text-light fs-12"></i>
                        </button>
                    </span>
                </div>
                <!-- <div role="dialog" class="v-dialog__container"></div> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-common-shadow border-none" id="profile_mobile" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="">
                    <div class="text-center fs-16 fw-bold">
                        Add New Phone Number
                    </div>
                    <form class="mt-3">
                        <div class="d-flex mobile_number_update align-items-center ">
                            <div class="ms-3">+880</div>
                            <input class="w-100 fs-14" type="text" placeholder="Mobile Number">
                        </div>
                        <div class="mobile-btn-reuest d-flex align-items-center me-2 mt-3">
                            <button type="button" class="btn otp-request-btn">
                                Request OTP
                            </button>
                            <button type="button" class="btn modal-cancle-btn ms-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade modal-common-shadow border-none" id="profile_dob" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="">
                    <div class="text-center fs-16 fw-bold">
                        Add Date of Birth
                    </div>
                    <form class="mt-3">
                        <div class="d-flex mobile_number_update align-items-center ">
                            <input class="w-100 fs-14 px-3" type="date" placeholder="Mobile Number">
                        </div>
                        <div class="mobile-btn-reuest d-flex align-items-center me-2 mt-3">
                            <button type="button" class="btn otp-request-btn">
                                Request OTP
                            </button>
                            <button type="button" class="btn modal-cancle-btn ms-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<script>
    function mobile_modal() {
        $('#profile_mobile').modal('show');
    }

    function mobile_dob() {
        $('#profile_dob').modal('show');
    }
</script>