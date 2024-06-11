<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                    <a href="<?= admin_url('betting/admin/user') ?>" class="btn btn-success mright5">
                        <i class="fa-solid fa-arrow-left tw-mr-1"></i> Back to User </a>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_add_user'); ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <form id="add_user_form" autocomplete="off">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                <input type="hidden" name="id" id="id" value=" <?= isset($user) ? $user->id : '0' ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $full_name = isset($user) ? $user->full_name : '' ?>
                                        <?= render_input('full_name', _l('b_full_name'), $full_name, 'text', ['id' => 'full_name', '' => '']); ?>
                                        <span id="nameErr" class="text-danger"></span>

                                    </div>
                                    <div class="col-md-6 ">
                                        <?php $email = isset($user) ? $user->user_email : '' ?>
                                        <?= render_input('user_email', _l('b_email'), $email, 'email', ['id' => 'user_email', '' => '']); ?>
                                        <span id="user_emailErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $mobile = isset($user) ? $user->mobile : '' ?>
                                        <?= render_input('mobile', _l('b_mobile'), $mobile, 'text', ['id' => 'mobile', '' => '']); ?>
                                        <span id="mobileErr" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $country = isset($user) ? $user->country : '';
                                        $country_list = $this->db->get(db_prefix() . 'countries')->result_array();

                                        echo  render_select('country', $country_list, ['country_id', 'short_name'], _l('b_country'), $country, ['data-width' => '100%', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot');
                                        ?>
                                        <span id="countryErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        $currency = isset($user) ? $user->currency_id : '';
                                        $currencies = $this->db->get(db_prefix() . 'currencies')->result_array();

                                        echo  render_select('currency_id', $currencies, ['id', 'name'], 'Currency', $currency, ['data-width' => '100%', 'onchange' => 'currency(this.value)', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot', 'form-select');
                                        ?>
                                        <span id="currencyErr" class="text-danger"></span>
                                    </div>


                                    <div class="col-md-6 mtop10">
                                        <?php $country_code = isset($user) ? $user->country_code : '' ?>
                                        <?php
                                        echo render_select('country_code', $country_list, ['calling_code', 'short_name', 'calling_code'], 'Country Code', $country_code, ['data-width' => '100%', 'data-none-selected-text' => _l('b_select')], [], 'no-mbot', 'form-select');
                                        ?>
                                        <span id="country_codeErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mtop10">
                                        <?php $address = isset($user) ? $user->address : '' ?>
                                        <?= render_input('address', _l('b_address'), $address, 'text', ['id' => 'address', '' => '']); ?>
                                        <span id="addressErr" class="text-danger"></span>
                                    </div>

                                    <div class="col-md-6 mtop10">

                                        <label for="refference" class="control-label">agent refference</label>
                                        <select name="contact_id" id="contact_id" class="form-control" data-width="100%" data-live-search="true" tabindex="-98">

                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <?php $reference = isset($user) ? $user->reference : '' ?>
                                        <?= render_input('reference', _l('b_reference'), $reference, 'text', ['id' => 'reference', '' => '']); ?>
                                        <span id="referenceErr" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 ">
                                        <?= render_input('password', _l('b_password'), '', 'password', ['id' => 'password', '' => '']); ?>
                                        <span id="passwordErr" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 ">
                                        <?= render_input('confirm_password', _l('b_cpassword'), '', 'password', ['id' => 'confirm_password', '' => '']); ?>
                                        <span id="confirm_passwordErr" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6 "></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mtop15">Save</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>



<?php init_tail(); ?>


<script>
    $(document).ready(function() {
        currency($('#currency_id').val());

    });


    $('#add_user_form').submit(function(e) {
        e.preventDefault();
        var id = $('#id').val();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/insert_user') ?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    $.each(data, function(i, v) {
                        if (v != '') {
                            $('#' + i).html(v);
                        } else {
                            $('#' + i).html('');
                        }

                    });
                } else {
                    window.location.href = '<?= admin_url('betting/admin/user') ?>';
                    if (id == 0) {
                        alert_float('success', '<?= _l('b_success_save') ?>');
                    } else {
                        alert_float('success', '<?= _l('b_update_success') ?>');
                    }
                }
            }
        });
    });
</script>
<script>
    // function agent_mail(id) {

    //     $.ajax({
    //         url: "<?= admin_url('betting/admin/agent_check') ?>",
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>',
    //             "agent_email": id,
    //         },
    //         success: function(data) {
    //             if (data.return) {

    //                 $('#agent_mail_admin').css('border-color', 'green');
    //                 $('#agent_error').css('display', 'none');
    //                 $('#c_id').val(data.url['id']);
    //             } else {

    //                 $('#agent_mail_admin').css('border-color', 'red');
    //                 $('#agent_error').css('display', 'block');
    //             }


    //         },
    //         error: function(data) {
    //             // do something
    //         }
    //     });


    // }

    function currency(id) {
        $.ajax({
            url: "<?= base_url('betting/admin/get_agent') ?>",
            type: "POST",
            dataType: "json",
            data: {
                '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>',
                "c_id": id,
            },
            success: function(data) {
                
                $('#contact_id').empty();
                $('#contact_id').append('<option value="">Select Agent</option>');
                if (data != false) {
                    $.each(data, function(i, l) {
                        $.each(l, function(m, n) {
                            if (n.email) {
                                $('#contact_id').append('<option value=' + n.id + '>' + n.email + '</option>');
                            }

                        });
                    });
                } else {
                    $('#contact_id').empty();
                    $('#contact_id').append('<option value="">Not Agent This Currency</option>');
                }


            },
            error: function(data) {
                // do something
            }
        });
    }
</script>

</body>

</html>