<div class="modal fade lead-modal" id="winloss_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="winloss_modal"><?= _l('b_user') . ' ' . _l('b_betting') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for=""><?= _l('b_bet') . ' ' . _l('b_name') ?></label>
                                <select id="apply_bet_name" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <?php
                                    foreach ($name as $key => $value) {
                                        echo '<option value="' . $value->bet_name . '" data-subtext="' . $value->bet_key . '">' . $value->bet_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=""><?= _l('b_type') ?></label>
                                <div>
                                    <input type="radio" name="winloss" checked id="apply_win" value="1"> Win
                                    <input type="radio" name="winloss" id="apply_loss" value="0"> Loss
                                </div>

                            </div>
                            <div class="col-md-2">
                                <label for=""><?= _l('Apply') ?></label>
                                <div>
                                    <button class="btn btn-info" onclick="apply()">Apply</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <hr>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">

                                <label for=""><?= _l('b_status') ?></label>
                                <select onchange="bet_status(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <option value="2"><?php echo _l('Win'); ?></option>
                                    <option value="3"><?php echo _l('Loss'); ?></option>
                                    <option value="1" selected><?php echo _l('b_hold'); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for=""><?= _l('b_bet') . ' ' . _l('b_name') ?></label>
                                <select onchange="bet_name(this.value)" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                    <option value="0">All</option>
                                    <?php
                                    foreach ($name as $key => $value) {
                                        echo '<option value="' . $value->bet_name . '">' . $value->bet_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('b_sn'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('user_info'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' =>  _l('b_key'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_betting') . ' ' . _l('b_name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_rate'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' =>  _l('b_bet') . ' ' . _l('b_price'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_win') . ' ' . _l('b_price'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_status'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company', 'style' => 'width:100px'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_type'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company', 'style' => 'width:100px'),
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
                        render_datatable($table_data, 'winloss', [], [
                            'data-last-order-identifier' => 'customers',
                            'data-default-order'         => get_table_last_order('customers'),
                        ]);
                        ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <!-- <button type="submit" class="btn btn-primary"><?= _l('b_save') ?></button> -->

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>
<div class="_filters _hidden_inputs hidden">
    <?php
    echo form_hidden('sports_key', $bet->rel_id);
    echo form_hidden('type', 1);
    echo form_hidden('bet_name');
    ?>
</div>
<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-winloss', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/winloss-table', undefined, undefined, service_data, [0, "asc"]);

    function bet_status(i) {
        $('input[name="type"]').val(i);
        $('.table-winloss').DataTable().ajax.reload();
    }

    function bet_name(i) {
        $('input[name="bet_name"]').val(i);
        $('.table-winloss').DataTable().ajax.reload();
    }

    function apply() {
        var apply_bet_name = $('#apply_bet_name').val(),
            win = $('input[name="winloss"]').prop('checked');
        $.post('<?= admin_url(BETTING_MODULE_NAME . '/admin/apply') ?>', {
            name: apply_bet_name,
            win: win,
        }, function(data) {
            var e = JSON.parse(data);
            alert_float('success', e.message)
            $('.table-winloss').DataTable().ajax.reload();
        })
    }
</script>