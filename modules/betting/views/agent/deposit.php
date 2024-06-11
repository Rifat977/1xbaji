<?php
if (isset($_GET['status'])) {
    $url_id = $_GET['status'];
    if ($url_id == 3) {
        $data = $this->db->get_where(db_prefix() . 'deposit_history', ['contact_id' => get_contact_user_id()])->result();
    } else {
        $data = $this->db->get_where(db_prefix() . 'deposit_history', ['contact_id' => get_contact_user_id(), 'status' => $url_id])->result();
    }
} else {
    $data = $this->db->get_where(db_prefix() . 'deposit_history', ['contact_id' => get_contact_user_id()])->result();
}
?>
<style>
    @media only screen and (max-width: 600px) {
        #b_display {
            display: block !important;
            text-align: center !important;
        }
    }
</style>

<div class="panel_s">
    <div class="panel-body">
        <div class="mobaile-nav-tebs" style="display: none;" id="b_display">
            <div class="buttons">
                <a href="<?= site_url(BETTING_MODULE_NAME . '/client/agent') ?>" class="btn btn-info"><i class="fa fa-users"></i> Agent</a>
                <a href="<?= site_url(BETTING_MODULE_NAME . '/client/deposit?status=0') ?>" class="btn btn-info"><i class="fa fa-credit-card"></i> Deposit</a>
                <a href="<?= site_url(BETTING_MODULE_NAME . '/client/withraw?w_status=0') ?>" class="btn btn-info"><i class="fas fa-address-card"></i> Withdraw</a>
            </div>

        </div>
        <div style="margin: 10px; color: red;">
            <marquee> <?= get_option('agent_notice') ?></marquee>
        </div>


        <div class="row">

            <div class="<?= (agent_current_balance(get_contact_user_id()) > 0) ? 'alert alert-success' : 'alert alert-danger' ?>" role="alert">
                <div class="row">
                    <div class="col-md-6">
                        <span>Current Balance: <b><?= agent_current_balance(get_contact_user_id()) ?></b> </span>
                    </div>
                    <div class="col-md-6">
                        <p><span style="float: right; margin-left:10px"> Deposit Commission: <b><?= agent_deposit(get_contact_user_id()) . '%'  ?></b> </span> <span style="float: right;">Withdrow Commission: <b><?= agent_withdrow(get_contact_user_id()) . '%' ?></b> </span></p>
                    </div>
                </div>
            </div>

            <div class="panel_s">
                <div class="panel-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Status</label>
                                <select name="" onchange="find_status(this.value)" class="form-control" id="">
                                    <option <?= isset($_GET['status']) ? (($_GET['status'] == 3) ? "selected" : '') : '' ?> value="3">All</option>
                                    <option <?= isset($_GET['status']) ? (($_GET['status'] == 1) ? "selected" : '') : '' ?> value="1"><?php echo _l('accept') ?></option>
                                    <option <?= isset($_GET['status']) ? (($_GET['status'] == 2) ? "selected" : '') : '' ?> value="2"><?php echo _l('reject') ?></option>
                                    <option <?= isset($_GET['status']) ? (($_GET['status'] == 0) ? "selected" : '') : '' ?> value="0"><?php echo _l('pending') ?></option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div class="col-md-12">
                            <table class="table dt-table table-invoices" data-order-col="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th class="th-invoice-number"><?php echo _l('user_id'); ?></th>
                                        <th class="th-invoice-date"><?php echo _l('user_info'); ?></th>
                                        <th class="th-invoice-duedate"><?php echo _l('trans_info'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('remark'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_amount'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_date'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data) {
                                        foreach ($data as $key => $value) {
                                            $user_info = $this->db->get_where(db_prefix() . 'user', ['id' => $value->deposit_user_id])->row();
                                            if ($user_info) {
                                                $user_currency = $this->db->get_where(db_prefix() . 'currencies', ['id' => $user_info->currency_id])->row();
                                            }
                                            $agent_info = $this->db->get_where(db_prefix() . 'agent_details', ['id' => $value->agent_id])->row();
                                    ?>
                                            <tr>
                                                <td>USR-<?= isset($user_info)?$user_info->id:'' ?></td>
                                                <td><span><?= isset($user_info) ? $user_info->full_name : '' ?></span>
                                                    <p>Currency: <?= isset($user_currency) ? $user_currency->name : ''  ?> </br>Balance: <span style="color:blue"><?= isset($user_info)?number_format((own_balance($user_info->id) + hold_balance($user_info->id)), 2):'' ?></span> </br>Contact: <?= isset($user_info) ? $user_info->mobile : '' ?></p>
                                                </td>
                                                <td><span><?= isset($agent_info) ? $agent_info->type : '' ?></span>
                                                    <p>Phone: <?= isset($agent_info) ? $agent_info->details : '' ?> </br>TXID: <?= isset($value) ? $value->transactionID : '' ?></p>
                                                </td>
                                                <td><?= $value->remark ?></td>
                                                <td><?= number_format($value->amount, 2) ?></td>
                                                <td><?= time_ago($value->datetime) ?></td>

                                                <td>
                                                    <?php if ($value->status == 0) {
                                                        if (agent_current_balance(get_contact_user_id()) >= $value->amount) {
                                                    ?>
                                                            <a href="#" onclick="accept_status(<?= $value->deposit_id ?>,<?= $value->deposit_user_id ?>)"><span class="inline-block label" style="color: green;border: 1px solid green;">Accept</span></a>

                                                            <a href="#" onclick="reject_status(<?= $value->deposit_id ?>)"><span class="inline-block label" style="color: red;border: 1px solid red;">Reject</span></a>
                                                        <?php } else { ?>
                                                            <span class="inline-block label" style="color: red;border: 1px solid red;">Low balance</span>
                                                    <?php }
                                                    } ?>
                                                    <?php if ($value->status == 1) { ?>
                                                        <span class="inline-block label" style="color: green;border: 1px solid green;"><?php echo _l('accept') ?></span>
                                                    <?php } ?>
                                                    <?php if ($value->status == 2) { ?>
                                                        <span class="inline-block label" style="color: red;border: 1px solid red;"><?php echo _l('reject') ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function accept_status(id,user_id) {
            if (confirm("Are you sure?")) {
                $.post("<?= admin_url('betting/client/deposit_accept') ?>", {
                    deposit_id: id,
                    user_id: user_id
                }, function(data) {
                    //console.log(data);
                    window.location.reload();
                });
            } else {
                e.preventDefault();
            }

        }

        function reject_status(id) {
            if (confirm("Are you sure?")) {
                $.post("<?= admin_url('betting/client/deposit_reject') ?>", {
                    deposit_id: id
                }, function(data) {
                    window.location.reload();
                });
            } else {
                e.preventDefault();
            }

        }

        function find_status(id) {
            var temp = 'status';
            url = "<?= admin_url('betting/client/deposit') ?>?" + temp + '=' + id;
            window.location.replace(url);
        }
    </script>