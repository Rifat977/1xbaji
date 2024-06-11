<div class="modal fade lead-modal" id="agent_history" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="sports_view_modal"><?= _l('b_agent') . ' ' . _l('history') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#auto" aria-controls="auto" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('b_withdraw') ?></a></li>
                    <li role="presentation"><a href="#manual" aria-controls="manual" role="tab" data-toggle="tab"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?= _l('b_deposit') ?></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="auto">


                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('user_id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_currency'),
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
                        render_datatable($table_data, 'agent_withdraw', [], [
                            'data-last-order-identifier' => 'customers',
                            'data-default-order'         => get_table_last_order('customers'),
                        ]);
                        ?>

                        <script>
                            var service_data = {};
                            $.each($('._hidden_inputs._filters input'), function() {
                                service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
                            });
                            initDataTable('.table-agent_withdraw', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/agent_withdraw-table', undefined, undefined, service_data, [0, "asc"]);
                        </script>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="manual">


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
                                'name' =>  _l('b_amount'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
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
                        render_datatable($table_data, 'agent_deposit', [], [
                            'data-last-order-identifier' => 'customers',
                            'data-default-order'         => get_table_last_order('customers'),
                        ]);
                        ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>

<div class="_filters _hidden_inputs hidden">
    <?php
    echo form_hidden('agent_deposit_history', isset($commission) ? $commission->id : '');
    echo form_hidden('agent_withdrow_history', isset($commission) ? $commission->id : '');
    ?>
    <script>
        var service_data = {};
        $.each($('._hidden_inputs._filters input'), function() {
            service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });
        initDataTable('.table-agent_deposit', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/agent_deposti-table', undefined, undefined, service_data, [0, "asc"]);
    </script>