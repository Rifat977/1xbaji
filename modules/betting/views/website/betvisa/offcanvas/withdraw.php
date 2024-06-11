<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="withdraw" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Withdraw</h5>
        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <?php
        !empty($this->session->userdata('logged_in')) ? $user = $this->session->userdata('logged_in') : '';
        $balance = 0;
        if (isset($user)) {
            $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
            $currency_id =  $user_details->currency_id;
            $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
            $rate = $currency->price_value;
            $balance = own_balance($user->id);
        ?>

            <div class="row">
                <div class="col-md-6 mt-2"><button onclick="trs.show()" class="btn btn-primary form-control">Agent</button></div>
                <div class="col-md-6 mt-2"><button onclick="trs.show(true)" class="btn btn-primary form-control">Online</button></div>

            </div>
            <div class="row" id="trsonline" style="display: none;">
                <div class="mt-1"></div>
                <h6>Withdraw Your Amount</h6>
                <b> Current Rate: $1 = <?= $rate ?> <?= $currency->name ?></b>

                <div class="row mt-3" id="onlinepayment">
                    <?php if (get_option('paymentmethod_stripe_active') == 1) { ?>
                        <div class="col-md-4">
                            <a href="#" onclick="trs.banks()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/Bank-Manager.jpg') ?>">
                            </a>
                        </div>
                    <?php } ?>
                    <?php if (strlen(get_option('betting_coinbase_api_key')) > 1) { ?>
                        <div class="col-md-4">
                            <a href="#" onclick="trs.coinbase_payment()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/CBblogimage.jpg') ?>">
                            </a>
                        </div>
                    <?php } ?>
                    <div class="col-md-4">
                        <a href="#" onclick="trs.perfect_money()">
                            <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/perfect-money.jpg') ?>">
                        </a>
                    </div>
                    <div class="mt-2"></div>
                    <?php if (strlen(get_option('betting_usdt_address')) > 0) { ?>

                        <div class="col-md-4">
                            <a href="#" onclick="trs.usdt()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/Tether.png') ?>">
                            </a>
                        </div>

                    <?php   } ?>

                </div>
                <div id="transfer" style="display: none;" class="mt-3">
                    <div>
                        <div class="row">
                            <div class="col-md-12" style="display: none;" id="coin_panel">
                                <div class="form-group">
                                    <label class="control-label">Select Coin</label>
                                    <select class="form-control" id="trs_coin">
                                        <option value="0">Select</option>
                                        <option value="Bitcoin (BTC)">Bitcoin (BTC)</option>
                                        <option value="Ethereum (ETH)">Ethereum (ETH)</option>
                                        <option value="USD Coin (USDC)">USD Coin (USDC)</option>
                                        <option value="Dogecoin (DOGE)">Dogecoin (DOGE)</option>
                                        <option value="Litecoin (LTC)">Litecoin (LTC)</option>
                                        <option value="Dai (DAI)">Dai (DAI)</option>
                                        <option value="Bitcoin Cash (BHC)">Bitcoin Cash (BHC)</option>
                                        <option value="ApeCoin (APE)">ApeCoin (APE)</option>
                                        <option value="SHIBA INU (SHIB)">SHIBA INU (SHIB)</option>
                                        <option value="Tether (USDT)">Tether (USDT)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"><label class="control-label">Amount <b>(<?= number_format($balance, 2) ?>)</b></label>
                                    <input type="number" step="0.00" class="form-control" id="trs_amount">
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="form-group"><label class="control-label">Details</label>
                                    <textarea class="form-control" rows="5" id="trs_remark" placeholder="Bank Information / Bkash / Nogot / Roket / Wellet Address / Account No"></textarea>
                                </div>

                                <p>
                                    <br>
                                    <b>Bank Info:</b><br>
                                    Bank Name / Swift Code / Account No / Branch / Account Holder Name / Route No
                                    <br>
                                    <b>Bkash, Nagad, Rocket, Upay:</b><br>
                                    Name / Monile Number (must be personal)
                                    <br>
                                    <b>CoinBase:</b><br>
                                    Wallet Number
                                    <br>
                                    <b>Perfect Money:</b><br>
                                    Account No / Wallet No / Name
                                    <br>
                                    <b>USDT:</b> <br>
                                    Ensure the Network is Tron (TRC20)
                                    <br>
                                </p>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <button class="btn btn-success" onclick="trs.confirm_online()">Confirm</button>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="online_alert"></div>
            </div>
            <div class="row" id="trsoffline" style="display: none;">
                <br>
                <?php

                $country = $user_details->country;
                $clients = $this->db->get_where('tblclients', ['country' => $country])->result();

                ?>
                <div class="container px-4 py-2 inplay_container">

                    <div class="tab-pane fade show" id="today_all" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="cricket_inplay mb-4">
                            <div class="d-flex justify-content-between my-3">
                                <div class="category-heading">
                                    <h4>Select Agent</h4>
                                </div>
                                <a class="btn btn-light float-end view_all" data-bs-toggle="collapse" data-bs-target=".Cricket" aria-expanded="true">All <i class="fa-solid fa-chevron-up"></i></a>
                            </div>
                            <?php
                            foreach ($clients as $i1 => $client) {
                                foreach ($this->db->get_where('tblcontacts', ['userid' => $client->userid])->result() as $i2 => $contact) {
                                    $agents = $this->db->get_where('tblagent_details', ['contact_id' => $contact->id])->result();
                                    if (count($agents) > 0) {
                            ?>
                                        <div class="mb-2">
                                            <button type="button" class="btn w-100 bg-dark text-white text-start p-3 rounded-top rounded-5 view_single Cricket_collapse" data-bs-toggle="collapse" data-bs-target="#tab_<?= $i1 . $i2 ?>" aria-expanded="true" aria-controls="multiCollapseExample1"> <?= $contact->firstname . ' ' . $contact->lastname ?> <i class="fa-solid float-end fa-chevron-up"></i></button>
                                            <div class="Cricket collapse " id="tab_<?= $i1 . $i2 ?>">
                                                <div class="card card-body text-dark">
                                                    <h5>
                                                        <?php

                                                        foreach ($agents as $i3 => $agent) {
                                                        ?>

                                                            <?= $agent->type ?>


                                                        <?php }
                                                        echo '</h5>';
                                                        ?>
                                                        <div id="payment_alert_<?= $contact->id ?>"></div>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group"><label class="control-label">Amount <b>(<?= number_format($balance, 2) ?>)</b></label>
                                                                        <input type="number" step="0.00" id="trs_amount_<?= $contact->id ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"><label class="control-label">Details</label>
                                                                        <textarea class="form-control" rows="5" id="trs_remark_<?= $contact->id ?>" placeholder="Bank Information / Bkash / Nogot / Roket / Wellet Address / Account No"></textarea>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-12" style="margin-top: 10px;">
                                                                    <button class="btn btn-primary" onclick="trs.submit(<?= $contact->id ?>)">Withdraw</button>
                                                                </div>
                                                                <div id="agent_alert_<?= $contact->id ?>"></div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                            <?php }
                                }
                            } ?>


                        </div>
                    </div>





                </div>
            </div>

        <?php } else {
        ?>
            <a href="<?= base_url('betting/login') ?>" class="btn w-100 te">Login Now</a>
        <?php }

        $CI = &get_instance();
        $token_name = $CI->security->get_csrf_token_name();
        $csrf_hash  = $CI->security->get_csrf_hash();

        ?>
    </div>
</div>


<script>
    var trs = {
        type: 0,
        deposit: function() {
            var get = $('#amount').val();
            if (get > 0) {
                this.panel(true)
            } else {
                this.panel();
                alert('Type your amount')
            }
        },
        banks: function() {
            this.type = 1;
            $('#transfer').show();
            $('#onlinepayment').hide();
            $('#coin_panel').hide();
        },
        coinbase_payment: function() {
            this.type = 2;
            $('#transfer').show();
            $('#coin_panel').show();
            $('#onlinepayment').hide();

        },
        perfect_money: function() {
            this.type = 3;
            $('#transfer').show();
            $('#onlinepayment').hide();
            $('#coin_panel').hide();
        },
        show: function(d = false) {
            if (!d) {
                $('#trsoffline').show();
                $('#trsonline').hide();
            } else {
                $('#trsoffline').hide();
                $('#trsonline').show();
                $('#transfer').hide();
                $('#onlinepayment').show();

            }
        },
        usdt: function() {
            this.type = 4;
            $('#transfer').show();
            $('#onlinepayment').hide();
            $('#coin_panel').hide();
        },
        confirm_online: function() {
            var coin = $('#trs_coin').val(),
                amount = $('#trs_amount').val(),
                details = $('#trs_remark').val(),
                balance = <?= $balance ?>;
            if (balance >= amount) {
                $.post('<?= site_url(BETTING_MODULE_NAME . '/confirm_online') ?>', {
                    type: trs.type,
                    coin: coin,
                    details: details,
                    amount: amount,
                    "<?= $token_name ?>": '<?= $csrf_hash ?>'
                }, function(e) {
                    var a = JSON.parse(e);
                    if (a.return) {
                        $('#transfer').hide();
                        $('#online_alert').html('<div class="alert alert-success">' + a.message + '</div>');
                    } else {
                        $('#online_alert').html('<div class="alert alert-danger">' + a.message + '</div>');
                    }
                });
            } else {
                $('#online_alert').html('<div class="alert alert-warning">The amount is less than your balance.</div>');
            }
        },
        agent_payment: function(id) {
            $('#agent_payment_' + id).show();
        },
        hide_payment: function(id) {
            $('#agent_payment_' + id).hide();
        },
        submit: function(id) {
            var contact_id = id,
                details = $('#trs_remark_' + id).val(),
                amount = $('#trs_amount_' + id).val(),
                balance = <?= $balance ?>;
            if (balance >= amount) {
                $.post('<?= site_url(BETTING_MODULE_NAME . '/confirm_agent') ?>', {
                    contact_id: contact_id,
                    details: details,
                    amount: amount,
                    "<?= $token_name ?>": '<?= $csrf_hash ?>'
                }, function(e) {
                    var a = JSON.parse(e);
                    if (a.return) {
                        $('#trs_remark_' + id).val('');
                        $('#trs_amount_' + id).val('');
                        $('#agent_alert_' + id).html('<div class="alert alert-success">' + a.message + '</div>');
                    } else {
                        $('#agent_alert_' + id).html('<div class="alert alert-danger">' + a.message + '</div>');
                    }

                });
            } else {
                $('#agent_alert_' + id).html('<div class="alert alert-warning">The amount is less than your balance.</div>');
            }
        }
    };
</script>