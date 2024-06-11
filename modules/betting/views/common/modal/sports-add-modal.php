<div class="modal fade lead-modal" id="sports_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="exampleModalLabel"><?= _l('b_add') . ' ' . _l('b_sports') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
            if ($bet_actived == false) {
                echo form_open(admin_url(BETTING_MODULE_NAME . '/admin/add_sports'));
            } else {
                echo form_open(admin_url(BETTING_MODULE_NAME . '/admin/update_sports/' . $bet_actived->id));
            }
            ?>
            <div class="modal-body">

                <input type="hidden" name="type" value="<?= $type ?>">
                <input type="hidden" name="key" value="<?= $id ?>">

                <div class="row">
                    <div class="col-md-12">
                        <h4><?= $name ?></h4>
                        <p><?= $description ?></p>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <?php
                            if (isset($sports['output']) && count($sports['output'])) {
                                foreach ($sports['output'] as $key => $value) { ?>
                                    <tr>
                                        <td><?= strlen($value['home_team']) > 0 ? "<b>" . $value['home_team'] . " VS " . $value['away_team'] . "</b>" : "" ?><br><?= date("D M j G:i:s T Y", strtotime($value['commence_time'])) ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </table>


                    </div>

                    <div class="col-md-12">
                        <?php echo render_select('category', $category, ['id', 'name'], 'b_category', (!empty($bet_actived) && isset($bet_actived) ? $bet_actived->category_id : ''), ['data-width' => '100%', 'data-none-selected-text' => _l('b_select'), 'required' => ''], [], 'no-mbot'); ?>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <?php if ($bet_actived == false) { ?>
                    <button type="submit" class="btn btn-primary"><?= _l('b_save') ?></button>
                <?php } else { ?>
                    <button type="submit" class="btn btn-primary"><?= _l('b_update') ?></button>
                <?php } ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>