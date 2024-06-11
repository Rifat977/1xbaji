<div class="offcanvas offcanvas-bottom h-92vh" tabindex="-1" id="account_bank" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title text-center arial-font w-100 fw-bold" id="offcanvasBottomLabel">Password Change</h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div>
            <nav>
                <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                    <button class="nav-link active add-bank-wallet-btn d-flex me-3 flex-column align-items-center" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-net-banking.b8a3637.svg" alt="">
                        <div class="tab-title">Add Bank</div>
                    </button>
                    <button class="nav-link add-bank-wallet-btn d-flex flex-column align-items-center" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-wallet.6271a94.svg" alt="">
                        <div class="tab-title">Add Wallet</div>
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div>
                    <p class="arial-font">To change your Bank Account please contact our <span class="fw-bold">customer Support</span></p>
                </div>
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form class="form-inline change-password-form">
                        <div class="mb-3">
                            <label class="mb-2" for="">Account Name</label>
                            <div class="input-group input_solt mr-sm-2">
                                <input type="text" class="form-control" id="password" value="Simul H" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="">Select Bank</label>
                            <div class="input-group input_solt mr-sm-2">
                                <select class="w-100 px-3 form-select" name="" id="">
                                    <option value="">No data Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="">Bank Branch</label>
                            <div class="input-group input_solt mr-sm-2">
                                <input type="text" class="form-control" id="password" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="">Account Number</label>
                            <div class="input-group input_solt mr-sm-2">
                                <input type="text" class="form-control" id="password">
                            </div>
                        </div>
                        <button type="submit" class="changebtn">Add Bank</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form class="form-inline change-password-form">
                        <div class="mb-3">
                            <label class="mb-2" for="">Wallet Name</label>
                            <div class="input-group input_solt mr-sm-2">
                                <input type="text" class="form-control" id="password" value="Simul H" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="">Select Wallet</label>
                            <div class="input-group input_solt mr-sm-2">
                                <select class="w-100 px-3 form-select" name="" id="">
                                    <option value="">No data Available</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2" for="">Wallet Number</label>
                            <div class="input-group input_solt mr-sm-2">
                                <input type="text" class="form-control" id="password">
                            </div>
                        </div>
                        <button type="submit" class="changebtn">Add Wallet</button>
                    </form>
                </div>

            </div>
        </div>
    </div>