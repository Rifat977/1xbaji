<div class="modal fade" id="currencysetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Currency set</h4>
            </div>
            <form action="<?= admin_url('betting/admin/set_currency') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <?php $currency = $this->db->get('tblcurrencies')->result(); ?>
                    <?php $currency_new = $this->db->get('tblbet_currency')->result(); ?>
                    <?php $country = $this->db->get('tblcountries')->result(); ?>
                    <div class="row">

                        <?php foreach ($currency as $key) { ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b><?= $key->symbol ?></b> <?= $key->name ?></label>
                                    <select name="group[<?= $key->id ?>]" class="selectpicker" data-width="100%" data-none-selected-text="Not Selected" data-live-search="true" tabindex="-98">
                                        <option value="">Select option</option>
                                        <?php foreach ($currency_new as $keys) { ?>
                                            <option value="<?= $keys->currency_id ?>" <?= ($key->set_id == $keys->currency_id) ? 'selected' : '' ?>><?= $keys->currnecy_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="">Country Set</label>
                                    <select name="country[<?= $key->id ?>]" class="selectpicker" data-width="100%" data-none-selected-text="Not Selected" data-live-search="true" tabindex="-98">
                                        <option value="">Select option</option>
                                        <?php foreach ($country as $ttts) { ?>
                                            <option value="<?= $ttts->country_id ?>" <?= ($key->country_id == $ttts->country_id) ? 'selected' : '' ?>><?= $ttts->short_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>