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
                        <a href="#" class="btn btn-primary" onclick="relalise_commission()"><?= _l('b_c_realise') ?></a>
                        <br>
                        <!-- <div class="row">
                            <div class="col-md-3">
                                <label for=""><?= _l('b_agent') ?></label>
                                <select onchange="agent_info(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php
                                    foreach ($this->db->get('tblcontacts')->result() as $key) { ?>
                                        <option value="<?= $key->id ?>"><?= $key->firstname ?> <?= $key->lastname ?></option>
                                    <?php } ?>


                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=""><?= _l('b_country') ?></label>
                                <select onchange="country_info(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php

                                    foreach ($this->db->get('tblcountries')->result() as $key) { ?>
                                        <option value="<?= $key->country_id ?>"><?= $key->short_name ?></option>
                                    <?php }
                                    ?>


                                </select>
                            </div>
                        </div> -->
                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('SN'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('b_d_commission'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('b_w_amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('b_w_commission'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('b_w_amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('create'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            )

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'commission_history', [], [
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
    initDataTable('.table-commission_history', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/commission-history-table', undefined, undefined, service_data, [0, "asc"]);
</script>

<script>
    function relalise_commission() {
        $.post(admin_url + MODULE_NAME + '/admin/commission_relise', {}, function(a) {
            // var e = JSON.parse(a);
            // if (e.return) {

            // }
            alert_float('success', 'commission relise.');
            $('.table-commission_history').DataTable().ajax.reload();
        });
    }
</script>

</body>

</html>