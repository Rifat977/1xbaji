<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_usdt_deposit'); ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-3">

                                <label for=""><?= _l('b_status') ?></label>
                                <select onchange="find_status(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <option value="2"><?php echo _l('accept'); ?></option>
                                    <option value="3"><?php echo _l('reject'); ?></option>
                                    <option value="1" selected><?php echo _l('pending'); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=""><?= _l('b_user') ?></label>
                                <select onchange="usd_deposit(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php
                                    if ($deposit) {
                                        foreach ($deposit as $key) { ?>
                                            <option value="<?= $key->id ?>"><?= $key->full_name . ' (' . $key->id . ')' ?></option>
                                    <?php }
                                    } ?>


                                </select>
                            </div>

                        </div>
                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('user_id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('user_info'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('trans_info'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('remark'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_payment_geteways'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_action'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),


                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'usdt_deposit', [], [
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
    echo form_hidden('usd_deposit_info_get', 1);
    echo form_hidden('user_usd_info_get');

    ?>
</div>
<?php init_tail(); ?>

<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-usdt_deposit', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/usdt_deposit-table', undefined, undefined, service_data, [0, "asc"]);
</script>

<script>
    function accept_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= admin_url('betting/admin/deposit_accept') ?>", {
                deposit_id: id
            }, function(data) {
                $('.table-usdt_deposit').DataTable().ajax.reload();
            });
        } else {
            e.preventDefault();
        }

    }

    function reject_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= admin_url('betting/admin/deposit_reject') ?>", {
                deposit_id: id
            }, function(data) {
                $('.table-usdt_deposit').DataTable().ajax.reload();
            });
        } else {
            e.preventDefault();
        }

    }

    function find_status(id) {
        $('input[name="usd_deposit_info_get"]').val(id);
        $('.table-usdt_deposit').DataTable().ajax.reload();
    }

    function usd_deposit(id) {
        $('input[name="user_usd_info_get"]').val(id);
        $('.table-usdt_deposit').DataTable().ajax.reload();
    }
</script>

</body>

</html>