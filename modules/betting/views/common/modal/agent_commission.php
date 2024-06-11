<div class="modal fade lead-modal" id="agent_commission_model" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="winloss_modal"><?= _l('b_agent') . ' ' . _l('b_commission') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <input type="hidden" id="agent_id" value="<?= isset($commission) ? $commission->id : '' ?>">
                    <div class="col-md-6">
                        <div class="group">
                            <label for="">Deposit Commission</label>
                            <input type="number" id="agent_deposit" onblur="submit_commission()" class="form-control" value="<?= isset($commission) ? $commission->agent_deposit : '0.00' ?>" placeholder="%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="group">
                            <label for="">Withdraw Commission</label>
                            <input type="number" id="agent_withdrow" onblur="submit_commission()" class="form-control" name="" value="<?= isset($commission) ? $commission->agent_withdrow : '0.00' ?>" placeholder="%">
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <h4>Agent History</h4>
                <a href="#" style="margin-bottom: 10px;" onclick="add_agent_history()" class="btn btn-primary"><i class="fa fa-plus"></i> add</a>
                <br>
                <div class="row">
                    <div class="col-md-12">
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
                                'name' => _l('b_balance'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('remark'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('create'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            )

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'agent_history', [], [
                            'data-last-order-identifier' => 'customers',
                            'data-default-order'         => get_table_last_order('customers'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="submit"  class="btn btn-primary"><?= _l('b_save') ?></button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade lead-modal" id="add_agent_history" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="winloss_modal"><?= _l('b_agent') . ' ' . _l('history') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="group">
                    <label for="">Balance</label>
                    <input type="number" class="form-control" name="" id="give_balance">
                </div>
                <br>
                <div class="group">
                    <label for="">Remark</label>
                    <textarea name="" id="give_remark" cols="30" class="form-control" rows="10"></textarea>
                </div>


            </div>
            <div class="modal-footer">

                <button type="submit" onclick="save_agent_history()" class="btn btn-primary"><?= _l('b_save') ?></button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>

<div class="_filters _hidden_inputs hidden">
    <?php
    echo form_hidden('agent_id_hidden', isset($commission) ? $commission->id : '');

    ?>
</div>

<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-agent_history', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/agent_history-table', undefined, undefined, service_data, [0, "asc"]);

    function add_agent_history() {
        $('#agent_commission_model').modal('hide');
        $('#add_agent_history').modal('show');
    }

    function save_agent_history() {
        var agent_id = $('#agent_id').val();
        var give_balance = $('#give_balance').val();
        var give_remark = $('#give_remark').val();
        $.post(admin_url + MODULE_NAME + '/admin/add_agent_history', {
            id: agent_id,
            balance: give_balance,
            remark: give_remark
        }, function(a) {
            var e = JSON.parse(a);
            if (e.return) {
                $('#add_agent_history').modal('hide');
                $('.modal-backdrop').removeClass('modal-backdrop');
                comission_model(<?= isset($commission) ? $commission->id : '' ?>);
                alert_float('success', 'Add Successfully');
            }
        });
    }
</script>