<div class="modal fade" id="muster_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Muster Agent</h4>
            </div>
            <form action="<?= admin_url('betting/admin/add_muster_agent') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" value="<?= get_option('bet_master_agent_role') ?>" name="role" id="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" id="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="profile_image" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mobile</label>
                                <input type="text" class="form-control" name="phonenumber" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if (!is_language_disabled()) { ?>
                                <div class="form-group select-placeholder">
                                    <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?></label>
                                    <select name="default_language" data-live-search="true" id="default_language" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""><?php echo _l('system_default_string'); ?></option>
                                        <?php foreach ($this->app->get_available_languages() as $availableLanguage) {
                                            $selected = '';
                                            if (isset($member)) {
                                                if ($member->default_language == $availableLanguage) {
                                                    $selected = 'selected';
                                                }
                                            } ?>
                                            <option value="<?php echo $availableLanguage; ?>" <?php echo $selected; ?>>
                                                <?php echo ucfirst($availableLanguage); ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control password" name="password" autocomplete="off" required>
                                <span class="input-group-addon tw-border-l-0">
                                    <a href="#password" class="show_password" onclick="showPassword('password'); return false;"><i class="fa fa-eye"></i></a>
                                </span>
                                <span class="input-group-addon">
                                    <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Agent</button>
                </div>
            </form>
        </div>
    </div>
</div>