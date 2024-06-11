<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="deposit" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Deposit</h5>
        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <?php
        !empty($this->session->userdata('logged_in')) ? $user = $this->session->userdata('logged_in') : '';
        if (isset($user)) {
            $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
            $currency_id =  $user_details->currency_id;
            $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
            $rate = $currency->price_value;

        ?>

            <div class="row">
                <div class="col-md-6 mt-2"><button onclick="pay.show()" class="btn btn-primary form-control">Agent</button></div>
                <div class="col-md-6 mt-2"><button onclick="pay.show(true)" class="btn btn-primary form-control">Online</button></div>

            </div>
            <div class="row" id="online" style="display: none;">
                <div class="mt-1"></div>
                <h6>Deposit Your <b>(USD)</b> Amount</h6>
                <?php ?>
                <b> Current Rate: $1 = <?= $rate ?> <?= $currency->name ?></b>
                <div class="col-md-10">
                    <input class="form-control" type="number" step="0.00" id="amount">
                </div>
                <div class="col-md-2 mt-1">
                    <button class="btn btn-primary" onclick="pay.deposit()">Deposit</button>
                </div>

                <div class="row mt-3" id="payment">
                    <?php if (get_option('paymentmethod_stripe_active') == 1) { ?>
                        <div class="col-md-4">
                            <a href="#" onclick="pay.strip_payment()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/stripe-logo.png') ?>">
                            </a>
                        </div>
                    <?php } ?>
                    <?php if (strlen(get_option('betting_coinbase_api_key')) > 1) { ?>
                        <div class="col-md-4">
                            <a href="#" onclick="pay.coinbase_payment()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/CBblogimage.jpg') ?>">
                            </a>
                        </div>
                    <?php } ?>
                    <div class="col-md-4">
                        <a href="#" onclick="pay.perfect_money()">
                            <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/perfect-money.jpg') ?>">
                        </a>
                    </div>
                    <div class="mt-2"></div>
                    <?php if (strlen(get_option('betting_usdt_address')) > 0) { ?>

                        <div class="col-md-4">
                            <a href="#" onclick="pay.usdt()">
                                <img width="100%" height="100px" src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/Tether.png') ?>">
                            </a>
                        </div>

                    <?php   } ?>
                </div>
                <div id="usdt" style="display: none;" class="mt-3">
                    <div>

                        <h4 style="text-align: center;">Address</h4>
                        <h5 style="text-align: center;"><b><?= get_option('betting_usdt_address')  ?></b></h5>
                        <h5 style="text-align: center;">Send only USDT to this deposit address.</h5>
                        <h5 style="text-align: center;">Ensure the Network is Tron (TRC20).</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <labelclass="control-label">Please Input Your Transaction ID</label>
                                        <input type="text" id="txid" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"><label class="control-label">Remark</label>
                                    <textarea class="form-control" id="remark"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <button class="btn btn-success" onclick="pay.confirm_usdt()">Confirm</button>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="usdt_alert"></div>
            </div>
            <div class="row" id="offline" style="display: none;">
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
                            ?>
                                    <div class="mb-2">
                                        <button type="button" class="btn w-100 bg-dark text-white text-start p-3 rounded-top rounded-5 view_single Cricket_collapse" data-bs-toggle="collapse" data-bs-target="#tab_<?= $i1 . $i2 ?>" aria-expanded="true" aria-controls="multiCollapseExample1"> <?= $contact->firstname . ' ' . $contact->lastname ?> <i class="fa-solid float-end fa-chevron-up"></i></button>
                                        <div class="Cricket collapse " id="tab_<?= $i1 . $i2 ?>">
                                            <div class="card card-body text-dark">
                                                <?php
                                                foreach ($this->db->get_where('tblagent_details', ['contact_id' => $contact->id])->result() as $i3 => $agent) {
                                                ?>
                                                    <a href="#" onclick="pay.agent_payment(<?= $agent->id ?>)">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="mt-2">
                                                                    <h5> <?= $agent->type ?> </h5>
                                                                    <p><?= $agent->details  ?></p>
                                                                </div>

                                                            </div>
                                                            <div>
                                                                <h3><i class="fa-solid fa-chevron-right"></i></h3>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div id="payment_alert_<?= $agent->id ?>"></div>
                                                    <div style="display: none;" id="agent_payment_<?= $agent->id ?>">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group"><label class="control-label">Amount</label>
                                                                    <input type="number" step="0.00" id="amount_<?= $agent->id ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <labelclass="control-label">TXID / Number</label>
                                                                        <input type="text" id="txid_<?= $agent->id ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group"><label class="control-label">Remark</label>
                                                                    <textarea class="form-control" id="remark_<?= $agent->id ?>"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" style="margin-top: 10px;">
                                                                <button class="btn btn-primary" onclick="pay.submit(<?= $agent->id ?>)">Deposit</button>
                                                                <button class="btn btn-danger" onclick="pay.hide_payment(<?= $agent->id ?>)">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
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
    var pay = {
        deposit: function() {
            var get = $('#amount').val();
            if (get > 0) {
                this.panel(true)
            } else {
                this.panel();
                alert('Type your amount')
            }
        },
        strip_payment: function() {
            window.location.href = "<?= site_url(BETTING_MODULE_NAME . '/payment/stripe') ?>?amount=" + $('#amount').val();
        },
        coinbase_payment: function() {
            window.location.href = "<?= site_url(BETTING_MODULE_NAME . '/payment/coinbase') ?>?amount=" + $('#amount').val();
        },
        perfect_money: function() {

        },
        show: function(d = false) {
            if (!d) {
                $('#offline').show();
                $('#online').hide();
            } else {
                $('#offline').hide();
                $('#online').show();
            }
        },
        panel: function(type = false) {
            if (!type) {
                $('#payment').hide();
            } else {
                $('#payment').show();
            }
        },
        usdt: function() {
            $('#usdt').show();
            $('#payment').hide();
        },
        confirm_usdt: function() {
            var txid = $('#txid').val(),
                remark = $('#remark').val(),
                amount = $('#amount').val();
            $.post('<?= site_url(BETTING_MODULE_NAME . '/usdt_payment') ?>', {
                id: 0,
                txid: txid,
                remark: remark,
                amount: amount,
                "<?= $token_name ?>": '<?= $csrf_hash ?>'
            }, function(e) {
                $('#usdt').hide();
                var a = JSON.parse(e);
                if (a.return) {
                    $('#usdt_alert').html('<div class="alert alert-success">' + a.message + '</div>');
                } else {
                    $('#usdt_alert').html('<div class="alert alert-danger">' + a.message + '</div>');
                }
            });
        },
        agent_payment: function(id) {
            $('#agent_payment_' + id).show();
        },
        hide_payment: function(id) {
            $('#agent_payment_' + id).hide();
        },
        submit: function(id) {
            var txid = $('#txid_' + id).val(),
                remark = $('#remark_' + id).val(),
                amount = $('#amount_' + id).val();
            $.post('<?= site_url(BETTING_MODULE_NAME . '/agent_payment') ?>', {
                id: id,
                txid: txid,
                remark: remark,
                amount: amount,
                "<?= $token_name ?>": '<?= $csrf_hash ?>'
            }, function(e) {
                pay.hide_payment(id);
                var a = JSON.parse(e);
                if (a.return) {
                    $('#payment_alert_' + id).html('<div class="alert alert-success">' + a.message + '</div>');
                } else {
                    $('#payment_alert_' + id).html('<div class="alert alert-danger">' + a.message + '</div>');
                }

            });
        }
    };
    pay.panel();
</script>