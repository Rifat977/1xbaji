<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Category</h4>
            </div>
            <form id="category_form">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" id="id" value="0">

                    <?= render_input('category', _l('b_category'), '', 'text', ['id' => 'category', 'required' => '']); ?>
                    <?= render_input('image', _l('image'), '', 'file', ['id' => 'image']); ?>
                    <div class="text-center">
                        <img id="imagesPreview" src="#" class="img-fluid" style="height: 200px; width: 400px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>