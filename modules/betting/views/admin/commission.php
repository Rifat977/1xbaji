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
                                <label for=""><?= _l('b_agent') ?></label>
                                <select onchange="agent_info(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value=""></option>
                                    <?php
                                    foreach ($this->db->get('tblcontacts')->result() as $key) { ?>
                                        <option value="<?= $key->id ?>"><?= $key->firstname ?> <?= $key->lastname ?></option>
                                    <?php }?>


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
                        </div>
                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('b_agent_id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_full_name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_email'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('Company'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_phone'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_position'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),

                            array(
                                'name' => _l('Last Login'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_active'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_country'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_commission'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_balance'),
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
                        render_datatable($table_data, 'commission', [], [
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
    echo form_hidden('agent_information');
    echo form_hidden('country_information');
    ?>
</div>

<?php init_tail(); ?>

<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-commission', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/commission-table', undefined, undefined, service_data, [0, "asc"]);
</script>

<script>
    function comission_model(id) {
        $.post(admin_url + MODULE_NAME + '/admin/agent_commission', {
            id: id
        }, function(a) {
            var e = JSON.parse(a);
            if (e.return) {
                $("#" + MODULE_MODAL).html(e.data);
                $("#agent_commission_model").modal('show');
                $('.selectpicker').selectpicker('refresh');
            } else {
                alert_float('danger', e.message);
            }
        });
    }
    
    function view_history(id) {
        $.post(admin_url + MODULE_NAME + '/admin/view_history', {
            id: id
        }, function(a) {
            var e = JSON.parse(a);
            if (e.return) {
                $("#" + MODULE_MODAL).html(e.data);
                $("#agent_history").modal('show');
                $('.selectpicker').selectpicker('refresh');
            } else {
                alert_float('danger', e.message);
            }
        });
    }

    function submit_commission() {
        var deposit = $('#agent_deposit').val();
        var withdrow = $('#agent_withdrow').val();
        var agent_id = $('#agent_id').val();
        if (parseFloat(deposit) > 0 && parseFloat(withdrow) > 0) {
            $.post(admin_url + MODULE_NAME + '/admin/update_agent_commission', {
                id: agent_id,
                deposit: deposit,
                withdrow: withdrow
            }, function(a) {
                var e = JSON.parse(a);
                if (e.return) {
                  
                 
                    alert_float('success', 'Commission Update Successfully');
                }
            });
        } else {
            alert_float('danger', 'Please Enter Only Number');
        }
    }
    function agent_info(id)
    {
        $('input[name="agent_information"]').val(id);
        $('.table-commission').DataTable().ajax.reload();
    }
    function country_info(id)
    {
        $('input[name="country_information"]').val(id);
        $('.table-commission').DataTable().ajax.reload();
    }
</script>

</body>

</html>