<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="withdraw_log" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Withdraw Log</h5>
        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">
        <?php
        if (!empty($_SESSION['logged_in'])) {
            $user_id = $_SESSION['logged_in']->id;
            $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();
            $ress = $this->db->get_where(db_prefix() . 'withraw_history', ['user_id' => $user_id])->result();
            foreach ($ress as $k => $val) {
        ?>
                <section class="px-4 py-3 fw-bold border-radius-5 mb-3 l-bg-blue-dark">
                    <div class="row">
                        <div class="col-8">
                            <p class="m-0 d-flex align-items-center"><span class="text-light">Amount</span><span class="currencyB fw-bold px-2 ms-2 py-1 brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span><span class="text-light ms-2"> <?= $val->amount ?></span></p>
                            <span class="text-light">Withdraw By <?= $val->type ?></span>
                            <p class="text-light m-0 fs-10"><span>Date :</span><?= $val->datetime ?></p>
                        </div>
                        <div class="col-4 p-0">
                            <?php
                            if ($val->status == 2) {
                                echo '<p class="text-light text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Holding...</p>';
                            } else if ($val->status == 1) {
                                echo '<p class="text-light text-bold text-center m-0 border-radius-5 greens py-1 px-2">Accepted</p>';
                            } else if ($val->status == 0) {
                                echo '<p class="text-light text-bold text-center m-0 border-radius-5 reds py-1 px-2">Rejected</p>';
                            }
                            ?>
                        </div>
                    </div>

                </section>
        <?php }
        }
        ?>



    </div>
</div>