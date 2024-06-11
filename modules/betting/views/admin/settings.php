<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_setting'); ?></h4>
                        <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open_multipart(); ?>
                                <ul class="nav nav-tabs" role="tablist">
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('b_odds_api') ?></a></li> -->
                                    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Cansino Api</a></li>
                                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?= _l('b_payment_geteways') ?></a></li>
                                    <li role="presentation"><a href="#system" aria-controls="system" role="tab" data-toggle="tab"><i class="fa fa-university" aria-hidden="true"></i> System</a></li>
                                    <!--<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li> -->
                                </ul>
                                <div class="tab-content">
                                    <!-- <div role="tabpanel" class="tab-pane active" id="home">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <hr>
                                                <div class="form-group">
                                                    <label for="paymentmethod_authorize_acceptjs_active" class="control-label clearfix">
                                                        Active </label>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="betting_odds1_api_active" name="settings[betting_odds_api_active]" <?php echo get_option('betting_odds_api_active') == 1 ? "checked" : "" ?> value="1">
                                                        <label for="betting_odds1_api_active">
                                                            Yes </label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="betting_odds2_api_active" name="settings[betting_odds_api_active]" <?php echo get_option('betting_odds_api_active') == 0 ? "checked" : "" ?> value="0">
                                                        <label for="betting_odds2_api_active">
                                                            No </label>
                                                    </div>
                                                </div>
                                                <div class="form-group" app-field-wrapper="settings[betting_odds_region]">
                                                    <?php
                                                    $basic = [
                                                        ['id' => 'us', 'name' => 'US', 'sub' => "United States"],
                                                        ['id' => 'uk', 'name' => 'UK', 'sub' => "United Kingdom"],
                                                        ['id' => 'eu', 'name' => 'EU', 'sub' => "European Union"],
                                                        ['id' => 'au', 'name' => 'AU', 'sub' => "Australia"],
                                                    ];
                                                    echo render_select('settings[betting_odds_region]', $basic, ['id', 'name', 'sub'], 'b_region',  get_option('betting_odds_region'), ['data-width' => '100%', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot'); ?>
                                                </div>
                                                <div class="form-group" app-field-wrapper="settings[betting_odds_oddsFormat]">
                                                    <?php
                                                    $basic = [
                                                        ['id' => 'american', 'name' => 'American', 'sub' => "small discrepancies might exist for some bookmakers due to rounding errors"],
                                                        ['id' => 'decimal', 'name' => 'Decimal', 'sub' => "Defaults to decimal"],
                                                    ];
                                                    echo render_select('settings[betting_odds_oddsFormat]', $basic, ['id', 'name', 'sub'], 'b_oddsFormat', get_option('betting_odds_oddsFormat'), ['data-width' => '100%', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot'); ?>
                                                </div>
                                                <div class="form-group" app-field-wrapper="settings[betting_odds_api_key]">
                                                    <label for="settings[betting_odds_api_key]" class="control-label"><?= _l("b_api_key") ?></label>
                                                    <input type="text" id="settings[betting_odds_api_key]" name="settings[betting_odds_api_key]" class="form-control" value="<?= get_option('betting_odds_api_key')  ?>">
                                                </div>
                                                <div class="form-group" app-field-wrapper="settings[betting_odds_scores]">
                                                    <label for="settings[betting_odds_scores]" class="control-label"><?= _l("b_score") ?></label>
                                                    <textarea type="text" id="settings[betting_odds_scores]" name="settings[betting_odds_scores]" rows="10" class="form-control"><?= get_option('betting_odds_scores')  ?></textarea>
                                                </div>
                                                <div class="form-group" app-field-wrapper="settings[betting_auto_timer]">
                                                    <label for="settings[betting_auto_timer]" class="control-label"><?= _l("b_timer") ?></label>
                                                    <input type="number" id="settings[betting_auto_timer]" name="settings[betting_auto_timer]" class="form-control" value="<?= get_option('betting_auto_timer')  ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div> -->

                                    <div role="tabpanel" class="tab-pane active" id="profile">
                                        <?php
                                        foreach (['betting_casino_games_marcent_key', 'betting_casino_games_marcent_id'] as $key => $name) { ?>
                                            <div class="form-group" app-field-wrapper="settings[<?= $name ?>]">
                                                <label for="settings[<?= $name ?>]" class="control-label"><?= $name ?></label>
                                                <input type="text" id="settings[<?= $name ?>]" name="settings[<?= $name ?>]" class="form-control" value="<?= get_option($name)  ?>">
                                            </div>
                                        <?php }    ?>



                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="messages">
                                        <div class="form-group" app-field-wrapper="settings[betting_coinbase_api_key]">
                                            <label for="settings[betting_coinbase_api_key]" class="control-label"><?= _l('b_coin_base') . ' ' . _l("b_api_key") ?></label>
                                            <input type="text" id="settings[betting_coinbase_api_key]" name="settings[betting_coinbase_api_key]" class="form-control" value="<?= get_option('betting_coinbase_api_key')  ?>">
                                        </div>

                                        <div class="form-group" app-field-wrapper="settings[betting_usdt_address]">
                                            <label for="settings[betting_usdt_address]" class="control-label"><?= _l('b_coin_base') . ' ' . _l("b_usdt_address") ?></label>
                                            <input type="text" id="settings[betting_usdt_address]" name="settings[betting_usdt_address]" class="form-control" value="<?= get_option('betting_usdt_address')  ?>">
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="system">
                                        <div class="form-group" app-field-wrapper="settings[betting_main_api_key]">
                                            <!-- <label for="settings[betting_main_api_key]" class="control-label">Betting Main API Key</label>
                                            <input type="text" id="settings[betting_main_api_key]" name="settings[betting_main_api_key]" class="form-control" value="<?= get_option('betting_main_api_key')  ?>"> -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <nav class="navbar navbar-inverse">
                                                        <div class="container-fluid" style="color: white;text-align:center;margin-top:13px">
                                                            Agent Gateway
                                                        </div>
                                                    </nav>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Bkash</label>
                                                                <input type="file" class="form-control" name="bkash" id="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('bkash')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Nagad</label>
                                                                <input type="file" class="form-control" name="nagad" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('nagad')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Rocket</label>
                                                                <input type="file" class="form-control" name="rocket" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('rocket')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <nav class="navbar navbar-inverse">
                                                        <div class="container-fluid" style="color: white;text-align:center;margin-top:13px">
                                                            Online Gateway
                                                        </div>
                                                    </nav>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Bank</label>
                                                                <input type="file" class="form-control" name="bank" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('bank')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Stripe</label>
                                                                <input type="file" class="form-control" name="stripe" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('stripe')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Coinbase</label>
                                                                <input type="file" class="form-control" name="coinbase" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('coinbase')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Perfect Money</label>
                                                                <input type="file" class="form-control" name="perfect_money" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('perfect_money')) ?>" style="height: 55px; width:55px" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Usdt</label>
                                                                <input type="file" class="form-control" name="usdt" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="<?= base_url('modules/betting/upload/agent/' . get_option('usdt')) ?>" style="height: 55px; width:55px" alt="">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_super_agent_role]">
                                                        <label for="settings[bet_super_agent_role]" class="control-label">Super Agent Role</label>
                                                        <select id="role" name="settings[bet_super_agent_role]" class="selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($this->db->get('tblroles')->result() as $key => $value) {
                                                                echo '<option ' . (get_option('bet_super_agent_role') == $value->roleid ? 'selected' : '') . ' value="' . $value->roleid . '">' . $value->name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_master_agent_role]">
                                                        <label for="settings[bet_master_agent_role]" class="control-label">Master Agent Role</label>
                                                        <select id="role" name="settings[bet_master_agent_role]" class="selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($this->db->get('tblroles')->result() as $key => $value) {
                                                                echo '<option ' . (get_option('bet_master_agent_role') == $value->roleid ? 'selected' : '') . ' value="' . $value->roleid . '">' . $value->name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_super_agent_commission]">
                                                        <label for="settings[bet_super_agent_commission]" class="control-label">Super Agent Commission</label>
                                                        <input type="number" id="settings[bet_super_agent_commission]" name="settings[bet_super_agent_commission]" class="form-control" value="<?= get_option('bet_super_agent_commission')  ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_master_agent_commission]">
                                                        <label for="settings[bet_master_agent_commission]" class="control-label">Master Agent Commission</label>
                                                        <input type="number" id="settings[bet_master_agent_commission]" name="settings[bet_master_agent_commission]" class="form-control" value="<?= get_option('bet_master_agent_commission')  ?>">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_default_contact_id]">
                                                        <label for="settings[bet_default_contact_id]" class="control-label">Default Agent</label>
                                                        <select id="role" name="settings[bet_default_contact_id]" class="selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($this->db->get('tblcontacts')->result() as $key => $value) {
                                                                echo '<option ' . (get_option('bet_default_contact_id') == $value->id ? 'selected' : '') . ' value="' . $value->id . '">' . $value->firstname .' '.$value->lastname. '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="settings[bet_default_contact_id]">
                                                        <label for="" class="control-label">telegram link</label>
                                                        <input type="text" class="form-control" name="settings[telegram_link]" value="<?= get_option('telegram_link')  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="">
                                                        <label for="" class="control-label">Agent Notice</label>
                                                        <input type="text" class="form-control" name="settings[agent_notice]" value="<?= get_option('agent_notice')  ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group" app-field-wrapper="">
                                                        <label for="" class="control-label">Company Name</label>
                                                        <input type="text" class="form-control" name="settings[company_name]" value="<?= get_option('company_name')  ?>">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary"><?= _l('b_save') ?></button>
                                <?php echo form_close(); ?>
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
</div>

<?php init_tail(); ?>

<script>


</script>

</body>

</html>