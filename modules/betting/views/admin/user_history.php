<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                    <a href="<?= admin_url('betting/admin/user') ?>" class="btn btn-primary mright5">
                    <i class="fa-solid fa-arrow-left"></i> User List</a>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('User Details'); ?></h4>
                        <span style="float: right;margin-top:-100px">Balance Amount : <b class="btn btn-primary" disabled><?= number_format(own_balance($user_id), 2) ?></b></span>
                        <span style="float: right;margin-top:-20px">Qualified Amount : <b><?= number_format($settle_amount, 2) ?></b></span>
                        <hr class="hr-panel-heading">
                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('user_id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Action'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Debit'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Credit'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Round id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('GameID'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('CurrencyID'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Time'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'user_details', [], [
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
<div class="_filters _hidden_inputs3 hidden">
    <?php
    echo form_hidden('userid', $user_id);
    ?>
</div>
<?php init_tail(); ?>

<script>
    var service_data = {};
    $.each($('._hidden_inputs3._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-user_details', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/user_sattle-table', undefined, undefined, service_data, [0, "asc"]);
</script>

</body>

</html>