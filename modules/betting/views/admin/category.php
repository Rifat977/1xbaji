<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                    <button type="button" class="btn btn-primary mright5 btn_add">
                        <i class="fa-regular fa-plus tw-mr-1"></i> New Cetegory </button>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_category'); ?></h4>
                        <hr class="hr-panel-heading">
                        <?php

                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('b_sn'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),

                            array(
                                'name' => _l('name'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('image'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
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
                                'name' => _l('b_date'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                            array(
                                'name' => _l('b_action'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                'tfoot' => []
                            ),
                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'category', [], [
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

<?php $this->load->view($modal); ?>





<?php init_tail(); ?>


<script>
    $('.btn_add').click(function(e) {
        e.preventDefault();
        $('#category_form').trigger('reset');
        $('#categoryModal').modal('show');
        $('#category_form #id').val(0);
        $('#category').val('');
        $('#imagesPreview').attr('src', '').hide();
        $('#image').val('');
    });

    function category_edit(id, name, image) {
        $('#categoryModal').modal('show');
        $('#category_form').trigger('reset');
        $('#id').val(id);
        $('#category').val(name);
        $('#image').val('');
        if (image != '') {
            $('#imagesPreview').attr('src', image).show();
        } else {
            $('#imagesPreview').attr('src', '#').hide();
        }
    }

    $('#image').change(function() {
        var curElement = $('#imagesPreview');
        console.log(this);
        var reader = new FileReader();

        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            curElement.attr('src', e.target.result).show();
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    })

    function category_status(id, _status) {
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/admin/category_status/') ?>" + id + '/' + _status,
            dataType: "json",
            success: function(data) {
                alert_float('success', data);
            }
        });
    }

    $('#category_form').submit(function(e) {
        e.preventDefault();
        var id = $('#id').val();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/category_add') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                // window.location.reload();
                $('#categoryModal').modal('hide');
                $('.table-category').DataTable().ajax.reload();
            }
        });
    });


    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-category', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/category-table', undefined, undefined, service_data, [0, "asc"]);
</script>

</body>

</html>