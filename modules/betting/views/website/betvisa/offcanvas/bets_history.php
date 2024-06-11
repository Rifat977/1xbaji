<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="bets_history" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Bets History</h5>
        <button class="menu-cancles" type="button" onclick="bet_history_dates_close()" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">

        <div id="menu-tabs-btn" class="align-items-start">

            <div class="tab-content21 w-100" id="mn-pills-tabContent">
                <div class="container">
                    <?php
                    if (!empty($_SESSION['logged_in'])) {
                        $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $_SESSION['logged_in']->currency_id])->row();

                        $bet_history = $this->db->get_where(db_prefix() . 'bet_history', ['user_id' => $_SESSION['logged_in']->id])->result();

                        foreach ($bet_history as $k => $v) { ?>
                            <section class="px-4 py-3 fw-bold border-radius-5 mb-3 l-bg-blue-dark">
                                <div class="row">
                                    <div class="col-8">
                                        <p class="fs-5 text-light mb-0" data-bs-toggle="tooltip" title="Bet Name"> <?= $v->bet_name ?></p>
                                        <p class="m-0 d-flex">
                                            <span class="text-light">Amount</span>
                                            <span class="currencyB fw-bold px-2 ms-2 py-1 brTop test-dark fs-8"><?= !empty($currency_) ? $currency_->name : '' ?></span>
                                            <span class="text-light ms-2 font-size-16"> <?= $v->total ?></span>
                                        <p class="text-light mt-1 fs-10"><?= date('D d M Y H:i:s', strtotime($v->datetime)) ?></p>
                                        </p>
                                    </div>
                                    <div class="col-4 text-center p-0">
                                        <?php
                                        if ($v->bet_win == 1) {
                                            echo '<p class="text-light text-bold text-center m-0 border-radius-5 greens py-1 px-2">Win</p>';
                                        } else if ($v->bet_win == 2) {
                                            echo '<p class="text-light text-bold text-center m-0 border-radius-5 reds py-1 px-2">Loss</p>';
                                        } else if ($v->bet_win == 0) {
                                            echo '<p class="text-light text-bold text-center m-0 border-radius-5 bg-warning py-1 px-2">Pending...</p>';
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
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom" style="height: auto;border-radius: 30px 30px 0px 0px;" tabindex="-1" id="bet_history_dates" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark" style="border-radius: 30px 30px 0px 0px;">
        <h5 class="offcanvas-title text-white  m-auto" id="offcanvasBottomLabel">During</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-close text-white"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div class="row align-items-center">
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days('<?= date('d/m/Y') ?>')">
                    Today
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days('<?= date('d/m/Y', strtotime('-1 days')) ?>')">
                    From Yesterday
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days('<?= date('d/m/Y', strtotime('-7 days')) ?>')">
                    Last 7 Days
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // $('#date-range').dateRangePicker({
    // 		inline: true,
    // 		format: 'MM-DD-YYYY',
    // 		container: '#ccc',
    // 		alwaysOpen: false,
    // 		singleMonth: true,
    // 		showTopbar: false,
    // 		setValue: function(s) {

    // 			$(this).val('<?= date('d/m/Y') ?>');
    // 		}
    // 	})
    // 	.bind('datepicker-change', (e, data) => {
    // 		$('#date-range').val(data.value);
    // 	});

    // function bet_history_dates() {
    // 	$("#bet_history_dates").offcanvas('show');
    // }

    // function bet_history_dates_close() {
    // 	$("#bet_history_dates").offcanvas('hide');
    // }

    // function set_days(date) {
    // 	$('#date-range').val('');
    // 	var to_date = '<?= date("d/m/Y", strtotime("+1 days")) ?>';
    // 	$('#date-range').val(date + ' to ' + to_date);
    // }
</script>