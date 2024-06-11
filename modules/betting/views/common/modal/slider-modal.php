<!-- Modal -->
<div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sliderLabel">Slider</h4>
            </div>
            <form id="slider_form">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" id="slider_id" value="0">
                    <?= render_input('image', _l('b_image') . ' (200x400)', '', 'file', ['class' => 'file-input']); ?>
                    <div class="text-center">
                        <img id="imagePreview" src="#" class="img-fluid" style="height: 200px; width: 400px;">
                    </div>
                    <?= render_input('slider_url', _l('b_url'), '', 'text', ['id' => 'slider_url']); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>