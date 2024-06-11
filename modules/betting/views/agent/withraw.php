<?php
if (isset($_GET['w_status'])) {
    $url_id = $_GET['w_status'];
    if ($url_id == 3) {
        $data = $this->db->get_where(db_prefix() . 'withraw_history', ['contact_id' => get_contact_user_id(), 'gateway' => 0])->result();
    } else {
        $data = $this->db->get_where(db_prefix() . 'withraw_history', ['contact_id' => get_contact_user_id(), 'gateway' => 0, 'status' => $url_id])->result();
    }
} else {
    $data = $this->db->get_where(db_prefix() . 'withraw_history', ['contact_id' => get_contact_user_id(), 'gateway' => 0])->result();
    // echo json_encode($data);
    // die;
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
                        <p><span style="float: right; margin-left:10px"> Deposit Commission: <b><?= agent_deposit(get_contact_user_id()) . '%'  ?></b> </span> <span style="float: right;">Withdraw Commission: <b><?= agent_withdrow(get_contact_user_id()) . '%' ?></b> </span></p>
                    </div>
                </div>
            </div>

            <div class="panel_s">
                <div class="panel-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Status</label>
                                <select name="" onchange="find_w_status(this.value)" class="form-control" id="">
                                    <option <?= isset($_GET['w_status']) ? (($_GET['w_status'] == 3) ? "selected" : '') : '' ?> value="3">All</option>
                                    <option <?= isset($_GET['w_status']) ? (($_GET['w_status'] == 1) ? "selected" : '') : '' ?> value="1"><?php echo _l('accept') ?></option>
                                    <option <?= isset($_GET['w_status']) ? (($_GET['w_status'] == 2) ? "selected" : '') : '' ?> value="2"><?php echo _l('reject') ?></option>
                                    <option <?= isset($_GET['w_status']) ? (($_GET['w_status'] == 0) ? "selected" : '') : '' ?> value="0"><?php echo _l('pending') ?></option>
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
                                        <th class="th-invoice-amount"><?php echo _l('remark'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_w_amount'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_withdraw_currency'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_date'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($data as $key => $value) {
                                        $user_info = $this->db->get_where(db_prefix() . 'user', ['id' => $value->user_id])->row();
                                        $user_currency = $this->db->get_where(db_prefix() . 'currencies', ['id' => $user_info->currency_id])->row();
                                        $withdrow = $this->db->get_where(db_prefix() . 'currencies', ['id' => $value->currency_id])->row();
                                    ?>
                                        <tr>
                                            <td>USR-<?= $user_info->id ?></td>
                                            <td style="width: 200px;"><span><?= isset($user_info) ? $user_info->full_name : '' ?></span>
                                                <p>Currency: <?= isset($user_currency) ? $user_currency->name : ''  ?>
                                                    </br>Balance: <span style="color:blue"><?= number_format((own_balance($value->user_id) + hold_balance($value->user_id)), 2) ?></span>
                                                    </br>Contact: <?= isset($user_info) ? $user_info->mobile : '' ?>
                                                </p>
                                            </td>

                                            <td><?= $value->details ?></td>
                                            <td><?= number_format($value->amount, 2) ?></td>
                                            <td><?= $withdrow->name ?></td>
                                            <td><?= time_ago($value->datetime) ?></td>

                                            <td style="width: 150px;">
                                                <?php if ($value->status == 0) { ?>
                                                    <a href="#" onclick="accept_withdrow(<?= $value->id ?>)"><span class="inline-block label" style="color: green;border: 1px solid green;">Accept</span></a>
                                                    <a href="#" onclick="reject_withdrow(<?= $value->id ?>)"><span class="inline-block label" style="color: red;border: 1px solid red;">Reject</span></a>
                                                <?php } ?>
                                                <?php if ($value->status == 1) { ?>
                                                    <span class="inline-block label" style="color: green;border: 1px solid green;"><?php echo _l('accept') ?></span>
                                                <?php } ?>
                                                <?php if ($value->status == 2) { ?>
                                                    <span class="inline-block label" style="color: red;border: 1px solid red;"><?php echo _l('reject') ?></span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function accept_withdrow(id) {
            if (confirm("Are you sure?")) {
                $.post("<?= admin_url('betting/client/withdrow_accept') ?>", {
                    withdrow_id: id
                }, function(data) {
                    window.location.reload();
                });
            } else {
                e.preventDefault();
            }

        }

        function reject_withdrow(id) {
            if (confirm("Are you sure?")) {
                $.post("<?= admin_url('betting/client/withdrow_reject') ?>", {
                    withdrow_id: id
                }, function(data) {
                    window.location.reload();
                });
            } else {
                e.preventDefault();
            }

        }

        function find_w_status(id) {
            var temp = 'w_status';
            url = "<?= admin_url('betting/client/withraw') ?>?" + temp + '=' + id;
            window.location.replace(url);
        }
    </script>