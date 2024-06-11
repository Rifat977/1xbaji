<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_bet'); ?></h4>
                        <hr class="hr-panel-heading">

                        <ul class="nav nav-tabs" role="tablist">
                            <?php if (get_option('betting_odds_api_active') == 1) { ?>
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('b_odds_api') ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php if (get_option('betting_odds_api_active') == 1) { ?>
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="col-md-6">
                                        <p class="bold"><?= _l('b_filterby') ?></p>
                                    </div>
                                    <div class="col-md-6 text-right">

                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?php echo render_select('group', $group, ['groups', 'groups'], 'b_group', '', ['data-width' => '100%', 'data-none-selected-text' => _l('b_select'), 'onchange' => "bet.filter(this.value,'hidden_group','table-odds-bet')"], [], 'no-mbot'); ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                $basic = [
                                                    ['id' => 2, 'name' => _l('b_active')],
                                                    ['id' => 1, 'name' => _l('b_deactivate')]
                                                ];
                                                echo render_select('active', $basic, ['id', 'name'], 'betting', '', ['data-width' => '100%', 'data-none-selected-text' => _l('b_select'), 'onchange' => "bet.filter(this.value,'hidden_active','table-odds-bet')"], [], 'no-mbot'); ?>
                                            </div>

                                        </div>

                                        <hr>
                                        <div class="_filters2 _hidden_inputs2 hidden">
                                            <input type="hidden" name="group" id="hidden_group">
                                            <input type="hidden" name="active" id="hidden_active">
                                        </div>

                                        <?php

                                        $table_data = array();
                                        $_table_data = array(
                                            array(
                                                'name' => _l('b_sn'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ),

                                            array(
                                                'name' => _l('b_key'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('b_group'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                                'tfoot' => []
                                            ),

                                            array(
                                                'name' => _l('b_title'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('b_description'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('b_staff'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('b_date'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('betting') . ' ' . _l('b_status'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('b_action'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px;'),
                                                'tfoot' => []
                                            ),

                                        );
                                        foreach ($_table_data as $_t) {
                                            array_push($table_data, $_t);
                                        }

                                        render_datatable($table_data, 'odds-bet', [], [
                                            'data-last-order-identifier' => 'customers',
                                            'data-default-order'         => get_table_last_order('customers'),
                                        ]);


                                        ?>
                                    </div>
                                </div>
                            <?php } ?>

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

<?php init_tail(); ?>

<script>
    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-odds-bet', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/odds-bet-table', undefined, undefined, service_data, [0, "asc"]);



    function on_off_switch(id, status) {
        //console.log(id,status);
        $.post("<?= admin_url() . 'betting/admin/update_status' ?>", {
            bet_id: id,
            status: status
        }, function(data) {
            alert_float('success', '<?= _l('b_update_success') ?>');
            $('.table-odds-bet').DataTable().ajax.reload();
        });
    }

    function delete_(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= admin_url() . 'betting/admin/delete_bet' ?>", {
                bet_id: id
            }, function(data) {
                alert_float('success', '<?= _l('b_success_delete') ?>');
                $('.table-odds-bet').DataTable().ajax.reload();
            });
        } else {
            e.preventDefault();
        }

    }
</script>

</body>

</html>