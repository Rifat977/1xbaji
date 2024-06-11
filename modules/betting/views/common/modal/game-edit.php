<!-- Modal -->
<div class="modal fade" id="game_edit" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">edit Game</h4>
            </div>
            <form id="game_list_update">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" id="game_id">
                    <div class="form-group">
                       
                        <label for="">Hot Game</label>
                        <div class="onoffswitch">
                            <input type="checkbox" name="hot_game" class="onoffswitch-checkbox" id="ck_hotgames">
                            <label class="onoffswitch-label" for="ck_hotgames"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Image Link</label>
                        <input type="text" class="form-control" name="game_url" id="image_url">
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