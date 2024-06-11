<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="affiliate_withdraw" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Affiliate Withdraw</h5>
        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small p-0">
        <section>
            <div class="row p-4" id="trsonline">
                <div class="mt-1"></div>
                <h6>Withdraw Your Amount</h6>
                <b> Current Rate: $1 = 100 BDT</b>
                <div id="transfer" class="mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label fw-bold">Amount</label>
                                <input type="number" step="0.00" class="form-control" id="trs_amount">
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group"><label class="control-label fw-bold">Details</label>
                                <textarea class="form-control" rows="5" id="trs_remark" placeholder="Bank Information / Bikash / Nagad / Rocket / Wallet Address / Account No"></textarea>
                            </div>
                            <div class="mt-3">
                                <p>
                                    <b>Bank Info:</b><br>
                                    Bank Name / Swift Code / Account No / Branch / Account Holder Name / Route No
                                </p>
                                <p>
                                    <b>Bkash, Nagad, Rocket, Upay:</b><br>
                                    Name / Monile Number (must be personal)
                                </p>
                                <p>
                                    <b>CoinBase:</b><br>
                                    Wallet Number
                                </p>
                                <p>
                                    <b>Perfect Money:</b><br>
                                    Account No / Wallet No / Name
                                </p>
                                <p>
                                    <b>USDT:</b> <br>
                                    Ensure the Network is Tron (TRC20)
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <button class="btn btn-success" onclick="trs.confirm_online()">Confirm</button>
                        </div>

                    </div>
                </div>
            </div>
            <div id="online_alert"></div>
    </div>
    </section>


</div>
</div>