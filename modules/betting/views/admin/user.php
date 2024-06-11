<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                    <a href="<?= admin_url('betting/admin/add_user') ?>" class="btn btn-primary mright5">
                        <i class="fa-regular fa-plus tw-mr-1"></i> New User </a>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_user'); ?></h4>
                        <hr class="hr-panel-heading">
                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('user_id'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            array(
                                'name' => _l('b_name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_email'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_mobile'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_country'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_currency'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_balance'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_reference'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_active'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_staff'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('Agent Name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('action'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email','style' => 'width:200px'),
                                'tfoot' => []
                            ),

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'user', [], [
                            'data-last-order-identifier' => 'customers',
                            'data-default-order'         => get_table_last_order('customers'),
                        ]);
                        ?>
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
    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-user', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/user-table', undefined, undefined, service_data, [0, "asc"]);
</script>

</body>

</html>