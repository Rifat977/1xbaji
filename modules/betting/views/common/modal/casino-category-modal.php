<!-- Modal -->
<div class="modal fade" id="casinoCategoryModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sliderLabel">Game Type</h4>
            </div>
            <form id="casino_category_form" action="<?= admin_url('betting/admin/casino_category') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="category_id" id="category_id" value="0">
                    <?= render_input('category_name', 'Game Type', '', 'text', ['required' => 'true']); ?>
                    <?= render_input('type_image', 'Game Type Image', '', 'file'); ?>
                    <?= render_input('order_by', 'Order By', '', 'text', ['required' => 'true']); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>