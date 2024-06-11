<!-- Modal -->
<div class="modal fade" id="provider_edit_model" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sliderLabel">provider</h4>
            </div>
            <form id="provider_form" action="<?= admin_url('betting/admin/provider_edit') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="provider_id" id="provider_id" value="0">
                    <?= render_input('provider_name', 'Provider name', '', 'text', ['required' => 'true']); ?>
                    <?= render_input('provider_image', 'Provider Image', '', 'file'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>