<?php

$CI = &get_instance();

$token_name = $CI->security->get_csrf_token_name();

$csrf_hash  = $CI->security->get_csrf_hash();

?>

<div class="container">
    <div class="depositeWidthraw">
            <div class="tab-pane fade active show" id="nav-deposite" role="tabpanel" aria-labelledby="nav-deposite-tab">

                <div class="deposit-wrapper mt-3">

                    <h6 class="mb-2 fw-bold thme-white-black-text">Payment Method</h6>

                    <div class="v-tabs mobile-grid-tabs ">

                        <div class="tab-content  " id="nav-tabContent">

                         
                                <div class="tab-pane fade active show  deposit-btn-plece border-0 " role="tabpanel" aria-labelledby="">

                                  

                                    <div class="mt-3">
                                            <?php
                                                    $user = $this->db->get_where('tbluser', ['id' => $this->session->userdata('logged_in')->id])->row();
                                                    $currency = $this->db->get_where('tblcurrencies', ['id' => $user->currency_id])->row();
                                                    
                                            ?>
                                        <form action="" class="change-password-form">

                                            <?php
                                            if($currency->name=='BDT'){ ?>
                                           
                                                <div class="mb-3">
                                                  <label class=" thme-white-black-text" for="">Select Gateway</label>
                                                    <div class=" input_solt " style="60px !important;">
                                                       <div class="input-group v-login-input-field position-relative mx-2" data-select2-id="4">
                                                        <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-earth-americas"></i></span>
                                                        <select class="form-control selection_select2 " name="BankCode" id="BankCode" data-select2-id="BankCode" tabindex="-1" aria-hidden="true">
                                                            <option value="0" >Select</option>
                                                            <option value="1001">BKASH</option>
                                                            <option value="1002">ROCKET</option>
                                                            <option value="1003">UPPAY</option>
                                                            <option value="1004">NAGAD</option>
                                                         </select>
                                                    </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            else if($currency->name=='PKR'){ ?>
                                                
                                                <div class="mb-3">
                                                  <label class=" thme-white-black-text" for="">Select Gateway</label>
                                                    <div class=" input_solt " style="60px !important;">
                                                       <div class="input-group v-login-input-field position-relative mx-2" data-select2-id="4">
                                                        <span class="input-group-text bg-transparent v-icon-login border-0 fs-20 "><i class="fa-solid fa-earth-americas"></i></span>
                                                        <select class="form-control selection_select2 " name="BankCode" id="BankCode" data-select2-id="BankCode" tabindex="-1" aria-hidden="true">
                                                            <option value="0" >Select</option>
                                                            <option value="Bank of Al Falah">Bank of Al Falah</option>
                                                            <option value="Bank of Punjab">Bank of Punjab</option>
                                                            <option value="EASYPAISA">EASYPAISA</option>
                                                            <option value="Faysal Bank">Faysal Bank</option>
                                                            <option value="FInca Mirco Finance Bank">FInca Mirco Finance Bank</option>
                                                            <option value="JAZZCASH">JAZZCASH</option>
                                                            <option value="Khushhuali Bank">Khushhuali Bank</option>
                                                            <option value="Mobilink Mirco Finance Bank">Mobilink Mirco Finance Bank</option>
                                                            <option value="UBLBANK">UBLBANK</option>
                                                         </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label class="mb-2 thme-white-black-text" for="">Account Name</label>
                                                    </div>
                                                    <div class="input-group input_solt mr-sm-2">
                                                        <input type="text" class="form-control" class="form-control"  id="AccountName">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label class="mb-2 thme-white-black-text" for="">Account No</label>
                                                    </div>
                                                    <div class="input-group input_solt mr-sm-2">
                                                        <input type="text" class="form-control" class="form-control"  id="AccountNo">
                                                    </div>
                                                </div>
                                                
                                            <?php }  ?>
                                          

                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="mb-2 thme-white-black-text" for="">Amount (<?= $currency->name ?>)</label>
                                                    <div class="text-danger fs-12"><i class="fa-solid fa-circle-info"></i> Min/Max Limit: 500/25,000</div>
                                                </div>

                                                <div class="input-group input_solt mr-sm-2">
                                                    <input type="text" class="form-control" class="form-control" placeholder="Min 500"  id="amount">
                                                </div>

                                            </div>

                                            

                                            <button type="button" onclick="deposit()" class="changebtn depositbtn">Deposit</button>

                                            <div id="" class="text-danger fs-12" style="display: none;">Min/Max Limit: 500/25,000</div>

                                        </form>

                                    </div>

                                </div>

                      

                        </div>

                    </div>

                </div>

               

            </div>

           

 

    </div>

</div>



<script>
function deposit(){
    var amount = $('#amount').val(),
    BankCode='',
    AccountName='',
    AccountNo='',
    currency ='<?= $currency->name ?>',error=false;
    
    if(amount>=500){
        
        if(currency=='BDT'){
            BankCode = $("#BankCode").val();
            if(BankCode==0){
                alert('Please select Gateway');
                error=true;
            }
        }
        else if(currency == 'PKR'){
            AccountName =  $("#AccountName").val();
            AccountNo =  $("#AccountNo").val();
            if(!AccountName){
                alert('Please enter account name');
                error=true;
            }
            if(!AccountNo){
                alert('Please enter account no');
                error=true;
            }
        }
        if(!error){
            $.post('<?= site_url(BETTING_MODULE_NAME . '/payment_g1_ajax') ?>', {
                    amount: amount,
                    BankCode:BankCode,
                    AccountName:AccountName,
                    AccountNo:AccountNo,
                    "<?= $token_name ?>": '<?= $csrf_hash ?>'
    
                }, function(e) {
                    var a = JSON.parse(e);
                    if(a.return){
                        window.location.href = a.url;
                    }
                    else{
                        alert(a.message)
                    }
    
    
    
                });
            }
           
        }
        else{
            alert('min amount 500.');
        }
    }
    

</script>