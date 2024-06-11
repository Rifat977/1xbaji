<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo isset($_GET['online']) ? _l('b_usdt_deposit') : _l('b_agent') . ' ' . _l('b_withdraw'); ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-3">

                                <label for=""><?= _l('b_status') ?></label>
                                <select onchange="find_status(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <option value="2"><?php echo _l('accept'); ?></option>
                                    <option value="3"><?php echo _l('reject'); ?></option>
                                    <option value="1" selected><?php echo _l('b_hold'); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=""><?= _l('b_user') ?></label>
                                <select onchange="user(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php
                                    if ($user) {
                                        foreach ($user as $key) { ?>
                                            <option value="<?= $key->id ?>"><?= $key->full_name . ' (USR-' . $key->id . ')' ?></option>
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
                                'name' => !isset($_GET['online']) ? _l('b_agent') : _l('trans_info'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_type'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('details'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_amount'),
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
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company', 'style' => 'width:100px'),
                                'tfoot' => ['class' => 'f_title']
                            ),


                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'withdraw', [], [
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
    echo form_hidden('user_id');
    echo form_hidden('online', isset($_GET['online']) ? 2 : 1);
    ?>
</div>

<?php init_tail(); ?>

<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-withdraw', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/withdraw-table', undefined, undefined, service_data, [0, "asc"]);
</script>

<script>
    function accept_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= admin_url('betting/admin/withdraw_accept') ?>", {
                id: id
            }, function(data) {
                var e = JSON.parse(data);
                if (e.return) {
                    alert_float('success', e.message);
                    $('.table-withdraw').DataTable().ajax.reload();
                } else {
                    alert_float('danger', e.message);
                }
            });
        }

    }

    function reject_status(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= admin_url('betting/admin/withdraw_reject') ?>", {
                id: id
            }, function(data) {
                var e = JSON.parse(data);
                if (e.return) {
                    alert_float('success', e.message);
                    $('.table-withdraw').DataTable().ajax.reload();
                } else {
                    alert_float('danger', e.message);
                }
            });
        }
    }

    function find_status(id) {
        $('input[name="usd_deposit_info_get"]').val(id);
        $('.table-withdraw').DataTable().ajax.reload();
    }

    function user(id) {
        $('input[name="user_id"]').val(id);
        $('.table-withdraw').DataTable().ajax.reload();
    }
</script>

</body>

</html>