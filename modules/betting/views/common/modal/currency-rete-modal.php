<div class="modal fade" id="currencyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Currency Rete</h4>
            </div>
            <form id="currency_rate_form">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="id" id="id" value="0">

                    <div class="row">
                        <?php
                        foreach ($this->db->get_where(db_prefix() . 'currencies')->result() as $v) { ?>
                            <div class="col-md-4">
                                <label>$USD to <?= $v->symbol.' '.$v->name ?></label>
                            </div>
                            <div class="col-md-8">
                                <?= render_input('price[' . $v->id . ']', 'Price '.$v->name, $v->price_value, 'text', ['required' => '']); ?>
                            </div>
                        <?php    }
                        ?>
                        <div class="col-md-12" style="display: none;">
                            <?php
                            $default = $this->db->get_where(db_prefix() . 'currencies', ['isdefault' => 1])->row()->name ?? '';
                            ?>
                            <?= render_input('usd', 'From', $default, 'text', ['id' => 'category', 'readonly' => 'true']); ?>

                        </div>
                        <div class="col-md-12" style="display: none;">
                            <?php
                            $currency = isset($user) ? $user->currency : '';
                            $currencies = $this->db->get_where(db_prefix() . 'currencies', ['isdefault' => 0])->result_array();

                            echo  render_select('currency_id', $currencies, ['id', 'name'], 'To', $currency, ['data-width' => '100%', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot', 'form-select');
                            ?>
                            <p class="mtop10 text-bold"><span class="current_currency_rate"></span></p>
                        </div>
                        <div class="col-md-12 mtop10" style="display: none;">
                            <?= render_input('price_value', 'Price Value', '0', 'text', ); ?>
                        </div>
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