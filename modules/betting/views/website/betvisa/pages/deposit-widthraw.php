<?php

$CI = &get_instance();

$token_name = $CI->security->get_csrf_token_name();

$csrf_hash  = $CI->security->get_csrf_hash();

?>

<div class="container">

    <div class="depositeWidthraw">

        <nav>

            <div class="nav nav-tabs banking-btn-plece border-0 rounded-3" id="nav-tab" role="tablist">

                <button class="nav-link active" id="nav-deposite-tab" data-bs-toggle="tab" data-bs-target="#nav-deposite" type="button" role="tab" aria-controls="nav-deposite" aria-selected="true">Deposit</button>

                <button class="nav-link" id="nav-widthraw-tab" data-bs-toggle="tab" data-bs-target="#nav-widthraw" type="button" role="tab" aria-controls="nav-widthraw" aria-selected="false">Widthraw</button>

            </div>

        </nav>

        <div class="tab-content p-3 pt-0 border-0 " id="nav-tabContent">

            <div class="tab-pane fade active show" id="nav-deposite" role="tabpanel" aria-labelledby="nav-deposite-tab">

                <div class="deposit-wrapper mt-3">

                    <h6 class="mb-2 fw-bold thme-white-black-text">Payment Method</h6>

                    <div class="v-tabs mobile-grid-tabs ">

                        <nav>

                            <div class="nav nav-tabs mb-3 deposit-btn-plece d-flex justify-content-between border-0" id="nav-tab" role="tablist">

                                <?php



                                $data = [];

                                if (!is_null($this->session->userdata('logged_in'))) {
                                    $data = $this->db->get_where('tbluser', ['id' =>  $this->session->userdata('logged_in')->id])->row();
                                }

                                //  echo json_encode($data);

                                $agent_id = 0;


                                if (!empty($data)) {

                                    $agent_id = $data->contact_id;

                                } else {

                                    $agent_id = get_option('bet_default_contact_id');

                                }



                                if ($agent_id == 0) {

                                    $agent_id = get_option('bet_default_contact_id');

                                }

                                $variable = $this->db->get_where('tblagent_details', ['contact_id' => $agent_id])->result();

                                foreach ($variable as $key => $value) {

                                    $name = '';

                                    $url = '';

                                    if ($value->type == 1) {

                                        $name = 'Bkash';

                                        $url =  'https://download.ocms365.com/v2/bv06/PaymentCategory.2.svg?version=3';

                                        if (0) {

                                            $url = base_url('modules/betting/upload/agent/' . get_option('bkash'));

                                        }

                                    } else if ($value->type == 2) {

                                        $name = 'Nagad';

                                        $url = 'https://download.ocms365.com/v2/bv06/PaymentCategory.3.svg?version=3';

                                        if (0) {

                                            $url = base_url('modules/betting/upload/agent/' . get_option('nagad'));

                                        }

                                    } else if ($value->type == 3) {

                                        $name = 'Rocket';

                                        $url = 'https://download.ocms365.com/v2/bv06/PaymentCategory.5?version=4';

                                        if (0) {

                                            $url = base_url('modules/betting/upload/agent/' . get_option('rocket'));

                                        }

                                    } else if ($value->type == 4) {

                                        $name = 'Upay';

                                        $url = 'https://seeklogo.com/images/U/upay-logo-44D7B11A45-seeklogo.com.png';

                                        if (0) {

                                            $url = base_url('modules/betting/upload/agent/' . get_option('upay'));

                                        }

                                    }

                                    echo '<button class="nav-link ' . ($key == 0 ? 'show active' : '') . ' " id="paytab' . $value->id . '" data-bs-toggle="tab" data-bs-target="#tab' . $value->id . '" type="button" role="tab" aria-controls="#tab' . $value->id . '" aria-selected="true">

                                                <div class="v-avatar">

                                                    <img class="w-100" alt="Bkash" src="' . $url . '" lazy="loaded">

                                                </div>

                                                <div class="tab-title">' . $name . '</div>

                                            </button>';

                                }





                                ?>





                            </div>

                        </nav>



                        <div class="tab-content  " id="nav-tabContent">

                            <h6 class="mt-3 fw-bold thme-white-black-text">Payment Chennals</h6>



                            <?php foreach ($variable as $key => $value) { ?>



                                <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>  deposit-btn-plece border-0 " id="<?= 'tab' . $value->id  ?>" role="tabpanel" aria-labelledby="<?= 'paytab' . $value->id  ?>">

                                    <div class="d-flex">

                                        <button onclick="payment_getaway1()" class="nav-link border-0 me-3" id="nav-bGetwaye1-tab" data-bs-toggle="tab" data-bs-target="#nav-bGetwaye1" type="button" role="tab" aria-controls="nav-bGetwaye1" aria-selected="false">

                                            <div class="v-avatar">

                                                <img class="w-100" alt="Bkash" src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-wallet.6271a94.svg" lazy="loaded">

                                            </div>

                                            <div class="tab-title" >GateWay 1</div>

                                        </button>

                                        <!--<button class="nav-link border-0 me-3" id="nav-bGetwaye2-tab" data-bs-toggle="tab" data-bs-target="#nav-bGetwaye2" type="button" role="tab" aria-controls="nav-bGetwaye2" aria-selected="false">-->

                                        <!--    <div class="v-avatar">-->

                                        <!--        <img class="w-100" alt="Bkash" src="https://download.ocms365.com/v2/bv06/PaymentCategory.2.svg?version=3" lazy="loaded">-->

                                        <!--    </div>-->

                                        <!--    <div class="tab-title">GateWay 2</div>-->

                                        <!--</button>-->
                                        
                                        <!-- <button class="nav-link border-0" id="nav-bGetwaye3-tab" data-bs-toggle="tab" data-bs-target="#nav-bGetwaye3" type="button" role="tab" aria-controls="nav-bGetwaye3" aria-selected="false">-->

                                        <!--    <div class="v-avatar">-->

                                        <!--        <img class="w-100" alt="Bkash" src="https://download.ocms365.com/v2/bv06/PaymentCategory.2.svg?version=3" lazy="loaded">-->

                                        <!--    </div>-->

                                        <!--    <div class="tab-title">GateWay 3</div>-->

                                        <!--</button>-->

                                    </div>

                                    <div class="mt-3">

                                        <form action="" class="change-password-form">

                                            <div class="mb-3" style="display: inline-block;">

                                                <label class="mb-2 thme-white-black-text" for="">Your Cash Out Number</label>

                                                <div class="input-group input_solt mr-sm-2" style="width: 80%;float: left;">

                                                    <input type="text" readonly class="form-control" value="<?= $value->details ?>">

                                                    <div class="w-100" id="text-to-copy<?= $value->id ?>" style="display: none;"><?= $value->details ?></div>

                                                </div>

                                                <div class="" style="width: 20%;float: left;">

                                                    <button type="button" style="width: 100px; height: 50px;" onclick="refer_link_copy(<?= $value->id ?>)" class="btn btn-warning rounded-pill position-relative copied-btn">Copy

                                                        <div class="copied-btn-icon" style="opacity: 0;"><i class="fa-regular fa-circle-check"></i></div>

                                                    </button>

                                                    <!-- <button type="button" id="refer_link_share" class="btn btn-dark w-50 rounded-pill py-2 ms-2">Share</button> -->

                                                </div>

                                            </div>

                                            <div class="mb-3">

                                                <div class="d-flex justify-content-between align-items-center">

                                                    <label class="mb-2 thme-white-black-text" for="">Amount</label>

                                                    <div class="text-danger fs-12"><i class="fa-solid fa-circle-info"></i> Min/Max Limit: 200/25,000</div>

                                                </div>

                                                <div class="input-group input_solt mr-sm-2">

                                                    <input type="text" class="form-control" onblur="max_min(this.value,<?= $value->id ?>)" class="form-control" placeholder="Min 300" id="amount_<?= $value->id ?>" value="">

                                                </div>

                                            </div>

                                            <div class="mb-3">

                                                <label class="mb-2 thme-white-black-text" for="">TXID</label>

                                                <div class="input-group input_solt mr-sm-2">

                                                    <input type="text" class="form-control" id="txid_<?= $value->id ?>" value="">

                                                </div>

                                            </div>

                                            <button type="button" onclick="pay.submit(<?= $value->id ?>)" id="diposit_btn" class="changebtn depositbtn">Deposit</button>

                                            <div id="alert_amount_<?= $value->id ?>" class="text-danger fs-12" style="display: none;">Min/Max Limit: 200/25,000</div>

                                        </form>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

                <div class="account-page-deposit-wrapper arial-font mt-5">

                    <div class="deposit-note-content-wrapper">

                        <h6 class="default-title text-danger arial-font" style="font-style: italic;">Important Notes</h6>

                    </div>

                    <div class="note-content arial-font">

                        <p class="thme-white-black-text">1. Deposits are subjected to a 1x wagering requirement.</p>

                        <p class="thme-white-black-text">2. Please always deposit to the latest QR codes / bank shown on this page. If scanning old QR codes and cause any delayed or lost, we will not be responsible.</p>

                        <p class="thme-white-black-text">3. After making a deposit transaction, please save successful receipts as proof.</p>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="nav-widthraw" role="tabpanel" aria-labelledby="nav-widthraw-tab">
                



                <div class="mt-3">

                    <nav>

                        <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                            
                                
                            <!-- <button class="nav-link active add-bank-wallet-btn d-flex me-3 flex-column align-items-center" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">

                                <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-net-banking.b8a3637.svg" alt="">

                                <div class="tab-title">Add Bank</div>

                            </button> -->

                            <button onclick="withdraw_getaway1()" class="nav-link  add-bank-wallet-btn d-flex flex-column align-items-center me-3" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">

                                <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-wallet.6271a94.svg" alt="">

                                <div class="tab-title">GateWay 1</div>

                            </button>

                            <!--<button onclick="withdraw_getaway1()" class="nav-link  add-bank-wallet-btn d-flex flex-column align-items-center me-3" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">-->

                            <!--    <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-wallet.6271a94.svg" alt="">-->

                            <!--    <div class="tab-title">GateWay 2</div>-->

                            <!--</button>-->
                            
                            <!--<button onclick="withdraw_getaway1()" class="nav-link  add-bank-wallet-btn d-flex flex-column align-items-center" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">-->

                            <!--    <img src="https://download.ocms365.com/pn/bv/v2/web/prod/build/v4.1.78/img/add-wallet.6271a94.svg" alt="">-->

                            <!--    <div class="tab-title">GateWay 3</div>-->

                            <!--</button>-->
                        </div>

                    </nav>

                    <div class="tab-content" id="nav-tabContent">

                        <div>

                            <p class="arial-font thme-white-black-text">To change your Bank Account please contact our <span class="fw-bold">customer Support</span></p>

                        </div>

                        <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <form class="form-inline change-password-form">

                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Account Name</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <input type="text" class="form-control" id="password" value="Simul H" readonly>

                                    </div>

                                </div>

                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Select Bank</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <select class="w-100 px-3 form-select" name="" id="">

                                            <option value="">No data Available</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Bank Branch</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <input type="text" class="form-control" id="password" />

                                    </div>

                                </div>

                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Account Number</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <input type="text" class="form-control" id="password">

                                    </div>

                                </div>

                                <button type="submit" class="changebtn">Add Bank</button>

                            </form>

                        </div>

                        <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <form class="form-inline change-password-form">

                                <?php

                                $contact_id = isset($_SESSION['logged_in']->contact_id) ? $_SESSION['logged_in']->contact_id : 0;

                                if ($contact_id == 0) {

                                    $contact_id = get_option('bet_default_contact_id');

                                }

                                $agent_dd = $this->db->get_where('tblcontacts', ['id' => $contact_id])->row();

                                ?>

                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Wallet Amount (<?= number_format(get_settle_balance($this->session->userdata('logged_in')->id), 2) ?>)</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <input type="text" class="form-control" id="trs_amount" placeholder="Min 300 Max 25000">

                                    </div>

                                </div>





                                <div class="mb-3">

                                    <label class="mb-2 thme-white-black-text" for="">Wallet Number with details</label>

                                    <div class="input-group input_solt mr-sm-2">

                                        <input type="text" class="form-control" id="trs_remark" placeholder="Bkash / Nogot / Roket / Wellet Address">

                                    </div>

                                </div>

                                <button type="button" class="changebtn" onclick="trans.submit()">Add Wallet</button>

                                <div id="agent_alert"></div>

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script>

    $(document).ready(function() {

        var main_balence = $('.tab-title').text();

        $(".tab-title").each(function(i) {

            len = $(this).text().length;

            if (len > 6) {

                $(this).text($(this).text().substr(0, 6) + '..');

            }

        });

        // $('#own_balance').hover(main_balence);

    })



    function max_min(amount, id) {

        if (299 < amount) {

            $('#alert_amount_' + id).css('display', 'none');

            $('.depositbtn').css('display', 'flex');



        } else {

            $('#alert_amount_' + id).css('display', 'inline');

            $('.depositbtn').css('display', 'none');

        }

    }

    function payment_getaway1(){
        window.location.href='<?= base_url('betting/payment_g1') ?>'
    }
    
    function withdraw_getaway1(){
        window.location.href='<?= base_url('betting/withdraw_g1') ?>'
    }
    
    var pay = {

        submit: function(id) {

            var txid = $('#txid_' + id).val(),

                remark = $('#txid_' + id).val(),

                amount = $('#amount_' + id).val();

            $.post('<?= site_url(BETTING_MODULE_NAME . '/agent_payment') ?>', {

                id: id,

                txid: txid,

                remark: remark,

                amount: amount,

                "<?= $token_name ?>": '<?= $csrf_hash ?>'

            }, function(e) {

                // pay.hide_payment(id);

                var a = JSON.parse(e);

                if (a.return) {

                    $('#txid_' + id).val('');

                    $('#amount_' + id).val('');

                    $('#alert_amount_' + id).css('display', 'inline');

                    $('#alert_amount_' + id).html('<div class="alert alert-success">' + a.message + '</div>');

                } else {

                    $('#alert_amount_' + id).html('<div class="alert alert-danger">' + a.message + '</div>');

                }



            });

        }

    };

    var trans = {

        submit: function() {

            var contact_id = <?= $agent_id ?>,

                details = $('#trs_remark').val(),

                amount = $('#trs_amount').val(),

                balance = <?= get_settle_balance($this->session->userdata('logged_in')->id) ?>;

            if (balance >= amount) {

                $.post('<?= site_url(BETTING_MODULE_NAME . '/confirm_agent') ?>', {

                    contact_id: contact_id,

                    details: details,

                    amount: amount,

                    "<?= $token_name ?>": '<?= $csrf_hash ?>'

                }, function(e) {

                    var a = JSON.parse(e);

                    if (a.return) {

                        $('#trs_remark').val('');

                        $('#trs_amount').val('');

                        $('#agent_alert').html('<div class="alert alert-success">' + a.message + '</div>');

                    } else {

                        $('#agent_alert').html('<div class="alert alert-danger">' + a.message + '</div>');

                    }



                });

            } else {

                $('#agent_alert').html('<div class="alert alert-warning">The amount is less than your maturied balance.</div>');

            }

        }

    };



    function refer_link_copy(id) {

        $('.copied-btn-icon').css('opacity', '1');

        var textToCopy = $('#text-to-copy' + id).text();

        var tempTextarea = $('<input>');

        $('body').append(tempTextarea);

        tempTextarea.val(textToCopy).select();

        document.execCommand('copy');

        tempTextarea.remove();



    }

    $('.copied-btn').blur(function() {

        ('.copied-btn-icon').css('opacity', '0 !important');

    })

</script>