<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo isset($_GET['online']) ? _l('b_usdt_deposit') : _l('b_agent') . ' ' . _l('b_withdraw'); ?></h4>
                        <hr>
                        <?php
                        if (!is_admin()) {
                            $this->db->where('staff_id', get_staff_user_id());
                        }
                        $pending = $this->db->select('SUM(amount) AS amount')->get_where('tblbet_agent_comission_withdraw',['status'=>0])->row()->amount;

                        if (!is_admin()) {
                            $this->db->where('staff_id', get_staff_user_id());
                        }
                        $reject = $this->db->select('SUM(amount) AS amount')->get_where('tblbet_agent_comission_withdraw',['status'=>2])->row()->amount;
                       

                        if (!is_admin()) {
                            $this->db->where('staff_id', get_staff_user_id());
                        }
                        $approved = $this->db->select('SUM(amount) AS amount')->get_where('tblbet_agent_comission_withdraw',['status'=>1])->row()->amount;
                       
                        ?>

                        <dl class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-3 sm:tw-gap-5 tw-mb-0">
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-warning">Pending </dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($pending, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-muted">Rejected</dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($reject, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                            <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-bg-white">
                                <div class="tw-px-4 tw-py-5 sm:tw-px-4 sm:tw-py-2">
                                    <dt class="tw-font-medium text-success">Approved</dt>
                                    <dd class="tw-mt-1 tw-flex tw-items-baseline tw-justify-between md:tw-block lg:tw-flex">
                                        <div class="tw-flex tw-items-baseline tw-text-base tw-font-semibold tw-text-primary-600"> $<?= number_format($approved, 2) ?> </div>
                                    </dd>
                                </div>
                            </div>
                        </dl>

                        <hr class="hr-panel-heading">
                        <?php
                        if (!is_admin()) { ?>
                            <a href="#" style="margin-left: 18px;" class="btn btn-primary muster-agent">Withdrow</a>
                            <hr>
                        <?php } ?>
                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('SN'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Staff'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),array(
                                'name' => _l('payble'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Address'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Status'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('Action'),
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




<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-agent_withdrow', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/agent-release', undefined, undefined, service_data, [0, "asc"]);


    function accept_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= base_url('betting/admin/commision_accepet') ?>", {
                id: id
            }, function(data) {
                $('.table-agent_withdrow').DataTable().ajax.reload();
            });
        } else {
            e.preventDefault();
        }
    }

    function reject_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= base_url('betting/admin/commision_reject') ?>", {
                id: id
            }, function(data) {
                $('.table-agent_withdrow').DataTable().ajax.reload();
            });
        } else {
            e.preventDefault();
        }
    }
</script>


</body>

</html>