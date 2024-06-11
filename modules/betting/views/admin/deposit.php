<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_deposit'); ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-4">

                                <label for=""><?= _l('b_user') ?></label>
                                <select onchange="user_data(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php
                                    if ($deposit) {
                                        foreach ($deposit as $key) { ?>
                                            <option value="<?= $key->id ?>"><?= $key->full_name . ' (USR-' . $key->id . ')' ?></option>
                                    <?php }
                                    } ?>


                                </select>
                            </div>
                            <div class="col-md-4">

                                <label for=""><?= _l('b_status') ?></label>
                                <select onchange="payment_data(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Payment</option>
                                    <option value="3">Reject</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('b_sn'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_mobile'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_trans'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' =>  _l('b_usd'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_c_rate'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' =>  _l('b_amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_gateway'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_currency'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ), array(
                                'name' => _l('b_status'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            )

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'deposit', [], [
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
    echo form_hidden('user_info_get');
    echo form_hidden('payment_info');
    ?>
</div>
<?php init_tail(); ?>

<script>
    function user_data(id) {
        $('input[name="user_info_get"]').val(id);
        $('.table-deposit').DataTable().ajax.reload();
    }

    function payment_data(id) {
        $('input[name="payment_info"]').val(id);
        $('.table-deposit').DataTable().ajax.reload();
    }

    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-deposit', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/deposit-table', undefined, undefined, service_data, [0, "asc"]);
</script>

</body>

</html>