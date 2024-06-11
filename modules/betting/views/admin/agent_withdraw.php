<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo isset($_GET['online']) ? _l('b_usdt_deposit') : _l('Commission') . ' ' . _l('Details'); ?></h4>
                        <hr>
                        <?php
                        if (!is_admin()) {
                            $this->db->where('staff_id', get_staff_user_id());
                        }
                        $commission = $this->db->select('SUM(usd_amount_commission) AS amount')->get_where('tblbet_agent_comission')->row()->amount;

                        if (!is_admin()) {
                            $this->db->where('staff_id', get_staff_user_id());
                        }
                        $withrow = $this->db->select('SUM(amount) AS amount')->get_where('tblbet_agent_comission_withdraw',['status'=>1 ])->row()->amount;
                        $balance = $commission -  $withrow;
                        ?>

                        <dl class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-3 sm:tw-gap-5 tw-mb-0">
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-warning">Total Commission </dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($commission, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-muted">Total Withdraw</dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($withrow, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-success">Balance</dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($balance, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <hr class="hr-panel-heading">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#rrr" aria-controls="auto" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('Commission') ?></a></li>
                            <li role="presentation"><a href="#sss" aria-controls="manual" role="tab" data-toggle="tab"><i class="fa-solid fa-money-bill"></i> <?= _l('Withdraw history') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="rrr">
                                <?php
                                if (!is_admin()) { ?>
                                    <a href="#" style="margin-left: 18px;" class="btn btn-primary muster-agent">Withdraw</a>
                                    <hr>
                                <?php } ?>

                                <div class="col-md-12">



                                    <?php
                                    $table_data = array();
                                    $_table_data = array(
                                        array(
                                            'name' => _l('SN'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Agent'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Deposit Amount'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Commission'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Currency'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Currency Rate'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ),
                                        array(
                                            'name' => _l('Local Amount'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ),  array(
                                            'name' => _l('Usd'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        ), array(
                                            'name' => _l('Create By'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                            'tfoot' => ['class' => 'f_title']
                                        )

                                    );
                                    foreach ($_table_data as $_t) {
                                        array_push($table_data, $_t);
                                    }
                                    render_datatable($table_data, 'agent_withdrow', [], [
                                        'data-last-order-identifier' => 'customers',
                                        'data-default-order'         => get_table_last_order('customers'),
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="sss">
                                <hr>
                                <div class="col-md-12">
                                    <table class="table dt-table table-invoices" data-order-col="0" data-order-type="desc">
                                        <thead>
                                            <tr>
                                                <th class="th-invoice-number"><?php echo _l('b_sn'); ?></th>
                                                <th class="th-invoice-date"><?php echo _l('b_balance'); ?></th>
                                                <th class="th-invoice-date"><?php echo _l('Payable amount'); ?></th>
                                                <th class="th-invoice-duedate"><?php echo _l('Address'); ?></th>
                                                <th class="th-invoice-amount"><?php echo _l('Status'); ?></th>
                                                <th class="th-invoice-amount"><?php echo _l('Create'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = $this->db->get_where(db_prefix() . 'bet_agent_comission_withdraw', ['staff_id' => get_staff_user_id()])->result();
                                            foreach ($data as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= number_format($value->amount, 2) ?></td>
                                                    <td><?= number_format((($value->amount) - 2), 2) ?></td>
                                                    <td><?= $value->address ?></td>
                                                    <?php
                                                    $status = '';
                                                    if ($value->status == 0) {
                                                        $status = '<span class="inline-block label" style="color: #ddae22;border: 1px solid #e9bb15;">Pending</span>';
                                                    } else if ($value->status == 1) {
                                                        $status = '<span class="inline-block label" style="color: #1aa811;border: 1px solid #0b9139;">Approved</span>';
                                                    } else {
                                                        $status = '<span class="inline-block label" style="color: #dd2265;border: 1px solid #e9155a;">Reject</span>';
                                                    }
                                                    ?>
                                                    <td><?= $status ?></td>
                                                    <td><?= $value->create_at ?></td>

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
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="_filters _hidden_inputs hidden">
    <?php
    echo form_hidden('user_id');

    ?>
</div>

<?php init_tail(); ?>

<div class="modal fade in" id="muster_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Withdraw</h4>
            </div>
            <?php echo form_open();  ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="number" step="0.00" class="form-control" name="amount" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Withdraw Address</label>
                            <textarea class="form-control" name="address" required=""></textarea>
                        </div>
                    </div>




                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-agent_withdrow', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/agent-withdrow', undefined, undefined, service_data, [0, "asc"]);

    $('.muster-agent').click(function() {
        $('#muster_modal').modal('show');

    });
</script>


</body>

</html>