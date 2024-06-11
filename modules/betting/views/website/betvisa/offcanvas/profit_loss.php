<div class="offcanvas offcanvas-bottom h-92vh menu-bg" tabindex="-1" id="deposit_log" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark text-light">
        <h5 class="offcanvas-title fw-bold m-auto" id="offcanvasBottomLabel">Profit Loss</h5>
        <button class="menu-cancles" type="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-sharp fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body small">

        <div id="menu-tabs-btn" class="align-items-start">
            <div class="nav nav-pills p-3 menu-overflow flex-nowrap hscroll" id="rew-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active fs-16 fw-bold p-0 me-4" id="w-pills-exchange3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-exchange3" type="button" role="tab" aria-controls="w-pills-exchange3" aria-selected="true">
                    Exchange
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-bookmaker2-tab" data-bs-toggle="pill" data-bs-target="#w-pills-bookmaker3" type="button" role="tab" aria-controls="w-pills-bookmaker3" aria-selected="false">
                    Bookmaker
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-fancybet3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-fancybet3" type="button" role="tab" aria-controls="w-pills-fancybet3" aria-selected="false">
                    Fancybet
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-sportsbook3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-sportsbook3" type="button" role="tab" aria-controls="w-pills-sportsbook3" aria-selected="false">
                    Sportsbook
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-parlay3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-parlay3" type="button" role="tab" aria-controls="w-pills-parlay3" aria-selected="false">
                    Parlay
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-casino3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-casino3" type="button" role="tab" aria-controls="w-pills-casino3" aria-selected="false">
                    Casino
                </button>
                <button class="nav-link fs-16 fw-bold p-0 me-4" id="w-pills-minigame3-tab" data-bs-toggle="pill" data-bs-target="#w-pills-minigame3" type="button" role="tab" aria-controls="w-pills-minigame3" aria-selected="false">
                    MiniGame
                </button>
            </div>

            <div class="tab-content21 w-100" id="rew-pills-tabContent">
                <div class="container">
                    <section class="p-3 text-warning d-flow-root ">
                        <div class="row">
                            <div class="col-md-9 col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-transparent  border-2 border-end-0 border-warning" id="basic-addon1"><i class="fa-solid fa-calendar-days text-warning"></i></span>
                                    <input type="text" id="date-range2" class="form-control bg-transparent date-range  border-2 border-start-0 border-warning text-white fw-bold" value="<?= date('d/m/Y') . ' to ' . date('d/m/Y', strtotime('+1 days')) ?>" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div id='ccc2'></div>
                            </div>
                            <div class="col-md-1 col-6 text-center">
                                <button class="btn btn-warning" onclick="bet_history_dates2()" type="button">...</button>
                            </div>
                            <div class="col-md-2 col-6 text-center">
                                <button class="btn btn-warning">Submit</button>
                            </div>

                        </div>
                    </section>
                    <div class="tab-pane fade show active" id="w-pills-exchange3" role="tabpanel" aria-labelledby="w-pills-exchange3-tab">

                    </div>

                    <div class="tab-pane fade" id="w-pills-bookmaker3" role="tabpanel" aria-labelledby="w-pills-bookmaker3-tab">
                    </div>
                    <div class="tab-pane fade" id="w-pills-fancybet3" role="tabpanel" aria-labelledby="w-pills-fancybet2-tab">
                    </div>
                    <div class="tab-pane fade" id="w-pills-sportsbook2" role="tabpanel" aria-labelledby="w-pills-sportsbook2-tab">
                    </div>
                    <div class="tab-pane fade" id="w-pills-parlay3" role="tabpanel" aria-labelledby="w-pills-parlay3-tab">
                    </div>
                    <div class="tab-pane fade" id="w-pills-casino3" role="tabpanel" aria-labelledby="w-pills-casino3-tab">
                    </div>
                    <div class="tab-pane fade" id="w-pills-minigame3" role="tabpanel" aria-labelledby="w-pills-minigame3-tab">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="offcanvas offcanvas-bottom" style="height: auto;border-radius: 30px 30px 0px 0px;" tabindex="-1" id="bet_history_dates2" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header bg-dark" style="border-radius: 30px 30px 0px 0px;">
        <h5 class="offcanvas-title text-white  m-auto" id="offcanvasBottomLabel">During</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-close text-white"></i></button>
    </div>
    <div class="offcanvas-body small">
        <div class="row align-items-center">
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days2('<?= date('d/m/Y') ?>')">
                    Today
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days2('<?= date('d/m/Y', strtotime('-1 days')) ?>')">
                    From Yesterday
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="btn btn-warning w-100" onclick="set_days2('<?= date('d/m/Y', strtotime('-7 days')) ?>')">
                    Last 7 Days
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // $('#date-range2').dateRangePicker({
    //         inline: true,
    //         format: 'MM-DD-YYYY',
    //         container: '#ccc2',
    //         alwaysOpen: false,
    //         singleMonth: true,
    //         showTopbar: false,
    //         setValue: function(s) {

    //             $(this).val('<?= date('d/m/Y') ?>');
    //         }
    //     })
    //     .bind('datepicker-change', (e, data) => {
    //         $('#date-range2').val(data.value);
    //     });

    // function bet_history_dates2() {
    //     $("#bet_history_dates2").offcanvas('show');
    // }

    // function bet_history_dates_close2() {
    //     $("#bet_history_dates2").offcanvas('hide');
    // }

    // function set_days2(date) {
    //     $('#date-range2').val('');
    //     var to_date = '<?= date("d/m/Y", strtotime("+1 days")) ?>';
    //     $('#date-range2').val(date + ' to ' + to_date);
    // }
</script>