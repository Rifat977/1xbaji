<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Master Agent Add</h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <a href="#" style="margin-left: 18px;" class="btn btn-primary muster-agent">Add Agent</a>
                        </div>
                        <br>
                        <?php

                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('b_sn'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('Email'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('PhoneNumber'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('Status'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),


                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'master_agent', [], [
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
<?php init_tail(); ?>
<?php $this->load->view($muster_agent) ?>
<script>
    $('.muster-agent').click(function() {
        $('#muster_modal').modal('show');

    });

    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-master_agent', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/master-table', undefined, undefined, service_data, [0, "asc"]);
</script>