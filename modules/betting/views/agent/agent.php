<div class="row">

    <style>
        .mobaile-nav-tebs ul {
            display: none;
        }

        @media only screen and (max-width: 600px) {
            .mobaile-nav-tebs ul {
                display: block;
            }

            #b_display {
                display: block !important;
                text-align: center !important;
            }

            /* .offcanvers_tabs {
                float: left;
            } */

            .offcanvers_tabs img {
                height: 70px;
                width: 70px;
            }

            .buttons a {
                margin-bottom: 10px;
            }
        }
    </style>



    <div class="panel_s">
        <div class="panel-body">

            <div class="mobaile-nav-tebs" style="display: none;" id="b_display">
                <div class="buttons">
                    <a href="<?= site_url(BETTING_MODULE_NAME . '/client/agent') ?>" class="btn btn-info"><i class="fa fa-users"></i> Agent</a>
                    <a href="<?= site_url(BETTING_MODULE_NAME . '/client/deposit?status=0') ?>" class="btn btn-info"><i class="fa fa-credit-card"></i> Deposit</a>
                    <a href="<?= site_url(BETTING_MODULE_NAME . '/client/withraw?w_status=0') ?>" class="btn btn-info"><i class="fas fa-address-card"></i> Withdraw</a>
                </div>

            </div>
            <div style="margin: 10px; color: red;">
                <marquee> <?= get_option('agent_notice') ?></marquee>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class=" <?= (agent_current_balance(get_contact_user_id()) > 0) ? 'alert alert-success' : 'alert alert-danger' ?> " role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Current Balance: <b><?= agent_current_balance(get_contact_user_id()) ?></b> </span>
                            </div>
                            <div class="col-md-6">
                                <p><span style="float: right; margin-left:10px"> Deposit Commission: <b><?= agent_deposit(get_contact_user_id()) . '%'  ?></b> </span> <span style="float: right;">Withdraw Commission: <b><?= agent_withdrow(get_contact_user_id()) . '%' ?></b> </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#rrr" aria-controls="auto" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('b_agent') ?> <?= _l('history') ?></a></li>
                    <li role="presentation"><a href="#sss" aria-controls="manual" role="tab" data-toggle="tab"><i class="fa-solid fa-money-bill"></i> <?= _l('b_balance') ?> <?= _l('history') ?></a></li>
                    <li role="presentation"><a href="#user_list" aria-controls="manual" role="tab" data-toggle="tab"><i class="fa-solid fa-users"></i> <?= _l('User') ?> <?= _l('List') ?></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="rrr">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <button class="btn btn-info model_open"><i class="fa fa-plus"></i> <?= _l('b_add') ?></button>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <table class="table dt-table table-invoices" data-order-col="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th class="th-invoice-number"><?php echo _l('b_sn'); ?></th>
                                        <th class="th-invoice-date"><?php echo _l('b_type'); ?></th>
                                        <th class="th-invoice-duedate"><?php echo _l('b_details'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('b_action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $this->db->get_where(db_prefix() . 'agent_details', ['contact_id' => get_contact_user_id()])->result();
                                    foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= ($value->type == '1') ? 'Bkash' : (($value->type == '2') ? 'Nagad' : (($value->type == '3') ? 'Rocket' : '')) ?></td>
                                            <td><?= $value->details ?></td>
                                            <td>
                                                <button class="btn btn-info" onclick="edit_agent(<?= $value->id ?>)"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-danger" onclick="delete_agent(<?= $value->id ?>)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="sss">
                        <!-- <div class="col-md-12" style="margin-bottom: 10px;">
                            <button class="btn btn-info model_open"><i class="fa fa-plus"></i> <?= _l('b_add') ?></button>
                        </div> -->
                        <hr>
                        <div class="col-md-12">
                            <table class="table dt-table table-invoices" data-order-col="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th class="th-invoice-number"><?php echo _l('b_sn'); ?></th>
                                        <th class="th-invoice-date"><?php echo _l('b_balance'); ?></th>
                                        <th class="th-invoice-duedate"><?php echo _l('remark'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('create'); ?></th>
                                        <th class="th-invoice-amount"><?php echo _l('date'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $this->db->get_where(db_prefix() . 'agent_history', ['agent_id' => get_contact_user_id()])->result();
                                    foreach ($data as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->balance ?></td>
                                            <td><?= $value->remark ?></td>
                                            <td><?= get_staff_full_name($value->create_at) ?></td>
                                            <td><?= time_ago($value->create_date) ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="user_list">

                        <hr>
                        <div class="col-md-12">
                            <table class="table dt-table table-invoices" data-order-col="0" data-order-type="desc">
                                <thead>
                                    <tr>
                                        <th class="th-invoice-number"><?php echo _l('b_sn'); ?></th>
                                        <th class="th-invoice-date"><?php echo _l('User Name'); ?></th>
                                        <th class="th-invoice-duedate"><?php echo _l('Email'); ?></th>
                                        <!-- <th class="th-invoice-duedate"><?php echo _l('Status'); ?></th> -->
                                        <th class="th-invoice-amount"><?php echo _l('create'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user = $this->db->get_where(db_prefix() . 'user', ['contact_id' => get_contact_user_id()])->result();
                                    if ($user) {
                                        foreach ($user as $key => $value) { ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $value->full_name ?></td>
                                                <td><?= $value->user_email ?></td>

                                                <!-- <td>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="" data-id="7" <?= ($value->is_active == 1) ? "checked" : "" ?> >
                                                        <label class="onoffswitch-label" for=""></label>
                                                    </div>
                                                </td> -->
                                                <td><?= $value->datetime ?></td>


                                            </tr>
                                    <?php }
                                    } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="agent_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add</h4>
                </div>
                <form id="agent_add_form">
                    <div class="modal-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <div class="form-group">
                            <select name="type" class="selectpicker" data-width="100%" data-none-selected-text="All" data-live-search="true" tabindex="-98">
                                <option value="1">Bkash</option>
                                <option value="2">Nagad</option>
                                <option value="3">Rocket</option>
                            </select>
                        </div>
                        <label for="">details</label>
                        <textarea name="details" id="details" class="form-control" cols="10" rows="8"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save_btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('.model_open').click(function(e) {
            $('#agent_add').modal('show');
            $('#type').val('');
            $('#details').val('');
            $('#hidden_id').val('');
            $('#save_btn').text('Save');
        });


        $('#agent_add_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= admin_url('betting/client/agent_add') ?>",
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                async: false,
                dataType: "json",
                success: function(data) {
                    window.location.reload();
                }
            });
        });

        function edit_agent(id) {
            $.post("<?= admin_url('betting/client/agent_edit') ?>", {
                agent_id: id
            }, function(data) {
                var t = JSON.parse(data);
                $('#agent_add').modal('show');
                $('#type').val(t.type);
                $('#details').val(t.details);
                $('#hidden_id').val(t.id);
                $('#save_btn').text('Update');
            });
        }

        function delete_agent(id) {
            $.post("<?= admin_url('betting/client/agent_delete') ?>", {
                delete: id
            }, function(data) {
                window.location.reload();

            });
        }
    </script>