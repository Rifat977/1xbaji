<!-- Modal -->
<div class="modal fade" id="casinoItemModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sliderLabel">Add Casino item</h4>
            </div>
            <form id="casino_item_form">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="">
                        <label for="#cat_id">Casino Category</label><br>
                        <select class="form-control" name="category_id" id="cat_id">
                            <option value="0">Select</option>
                            <?php
                            $query = $this->db->get(db_prefix() . 'casino_category')->result();
                            foreach ($query as $row) {
                            ?>
                                <option value="<?= $row->c_id ?>"><?= $row->category_name ?></option>

                            <?php }
                            ?>

                        </select>
                    </div>
                    <div class="sub_menus">
                        <label for="#sub_menus">Casino Sub Category</label><br>
                        <select class="form-control" name="casino_sub_category" id="sub_menus">
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div class="category_casinos">
                        <label for="#category_casinos">Sub Category Item</label><br>
                        <select class="form-control" name="category_casinos" id="category_casinos">
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div class="mtop15">
                        <?= render_input('image', _l('b_image') . ' (200x400)', '', 'file', ['class' => 'file-input']); ?>
                    </div>
                    <!-- <div class="text-center">
                        <img id="imagePreview" src="#" class="img-fluid" style="height: 200px; width: 400px;">
                    </div> -->
                    <?= render_input('casino_item_url', _l('b_url'), '', 'text') ?>
                    <span id="casinoItemUrlErr"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>