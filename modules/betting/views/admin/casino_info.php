<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();
$sub_category = array('');
$sub2 = array(1 => 'Catalog', 2 => 'Latest', 3 => 'A-Z');

?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Casino Info</h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="text-center">
                                <ul class="nav nav-tabs" role="tablist" id="myTab">
                                    <li class="active" data-toggle="tooltip" title="Game Type"><a href="#cssino_category" role="tab" data-toggle="tab">Game Type</a></li>
                                    <li data-toggle="tooltip" title="Provider List"><a href="#casino_item" role="tab" data-toggle="tab">Provider List</a></li>
                                    <li data-toggle="tooltip" title="Game List"><a href="#game_list" role="tab" data-toggle="tab">Game List</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="cssino_category">
                                    <div class="first">
                                        <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                            <!-- <button type="button" class="btn btn-primary mright5 add_category" data-toggle="tooltip" title="Add Category">
                                                <i class="fa-regular fa-plus tw-mr-1"></i>Add Category </button> -->
                                            <button type="button" id="sync" onclick="sync_casino('dd')" class="btn btn-primary mright5" data-toggle="tooltip" title="Sync"><i class="fa fa-refresh" aria-hidden="true"></i> Sync </button>
                                            <button type="button" style="display: none" ; id="syncing" class="btn btn-primary mright5" data-toggle="tooltip" title="Syncing"><i class="fas fa-sync fa-spin"></i> Syncing.. </button>

                                        </div>

                                        <?php

                                        $table_data = array();
                                        $_table_data = array(
                                            array(
                                                'name' => _l('b_sn'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ),

                                            array(
                                                'name' => 'Game Type',
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => 'Game Type Image',
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => 'Game Type Order',
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),

                                            array(
                                                'name' => _l('b_action'),
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


                                <div class="tab-pane " id="casino_item">
                                    <div class="first">
                                        <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                            <!-- <button data-toggle="tooltip" title="Add Casino Item" type="button" class="btn btn-primary mright5 add_item">
                                                <i class="fa-regular fa-plus tw-mr-1"></i>Add Item </button> -->
                                        </div>
                                        <?php

                                        $table_datas = array();
                                        $_table_datas = array(
                                            array(
                                                'name' => _l('b_sn'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ),
                                            array(
                                                'name' => _l('Provider id'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ),
                                            array(
                                                'name' => _l('Name'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), array(
                                                'name' => _l('Image'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), array(
                                                'name' => _l('type'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), array(
                                                'name' => _l('type'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), 
                                            array(
                                                'name' => _l('b_action'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),



                                        );
                                        foreach ($_table_datas as $_t) {
                                            array_push($table_datas, $_t);
                                        }
                                        render_datatable($table_datas, 'item', [], [
                                            'data-last-order-identifier' => 'customers',
                                            'data-default-order'         => get_table_last_order('customers'),
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane " id="game_list">
                                    <div class="first">
                                        <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                            <!-- <button data-toggle="tooltip" title="Add Casino Item" type="button" class="btn btn-primary mright5 add_item">
                                                <i class="fa-regular fa-plus tw-mr-1"></i>Add Item </button> -->
                                        </div>
                                        <?php

                                        $table_datas = array();
                                        $_table_datas = array(
                                            array(
                                                'name' => _l('b_sn'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), array(
                                                'name' => _l('Image'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ), array(
                                                'name' => _l('Name'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                                'tfoot' => ['class' => 'f_title']
                                            ),
                                            array(
                                                'name' => _l('Category'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('Provider'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('type'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),
                                            array(
                                                'name' => _l('Hote Game'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ), array(
                                                'name' => _l('action'),
                                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email'),
                                                'tfoot' => []
                                            ),



                                        );
                                        foreach ($_table_datas as $_t) {
                                            array_push($table_datas, $_t);
                                        }
                                        render_datatable($table_datas, 'game_list_t', [], [
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
</div>
</div>
</div>
</div>

<?php init_tail(); ?>

<?php $this->load->view($casino_category) ?>
<?php $this->load->view($casino_item) ?>
<?php $this->load->view($provider) ?>
<?php $this->load->view($edit_game) ?>
<script>
    $(".add_category").click(function() {
        $('#casino_category_form').trigger('reset');
        $('#casinoCategoryModal').modal('show');
    })
    $(".add_item").click(function() {
        $('#casinoItemModal').modal('show');
        $('#casino_item_form').trigger('reset');
        $('#id').val(0);
    })

    function casino_category_edit(id, category_name, item, order) {
        $('#casinoCategoryModal').modal('show');
        $('#category_id').val(id);
        $('#category_name').val(category_name);
        $('#type_image').val(item);
        $('#order_by').val(order);

    }
    $('#image').change(function() {
        var curElement = $('#imagePreview');
        console.log(this);
        var reader = new FileReader();

        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            curElement.attr('src', e.target.result).show();
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    })

    function provider_edit_f(id, provider_name, item) {
        $('#provider_edit_model').modal('show');
        $('#provider_id').val(id);
        $('#provider_name').val(provider_name);
        $('#provider_image').val(item);

    }
    $('#image').change(function() {
        var curElement = $('#imagePreview');
        console.log(this);
        var reader = new FileReader();

        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            curElement.attr('src', e.target.result).show();
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    })

    function casino_item_edit(id, category_id, image, casino_item_url) {
        $('#casinoItemModal').modal('show');
        $('#id').val(id);
        $('#cat_id').val(category_id);
        $('#image').val('');
        if (image != '') {
            $('#imagePreview').attr('src', image).show();
        } else {
            $('#imagePreview').attr('src', '#').hide();
        }
        $('#casino_item_url').val(casino_item_url);

    }

    function game_edit(id) {
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/get_game_list/') ?>" + id,
            dataType: "json",
            success: function(data) {
                $('#game_edit').modal('show');
                $('#game_id').val(id);
                $('#image_url').val(data.image_url);
                if(data.is_hot==0){
                    $('#ck_hotgames').prop('checked',false);
                }
                else
                {
                    $('#ck_hotgames').prop('checked',true);
                }

                
            }
        });



    }

    $('#casino_item_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/casino_item_add') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    $('#casinoItemUrlErr').html(data.casino_item_urlErr);
                } else {
                    $('#casinoItemModal').modal('hide');
                    $('.table-item').DataTable().ajax.reload();
                }

            }
        });
    });
    
    $('#game_list_update').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/game_update') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                if (data.return) {
                    $('#game_edit').modal('hide');
                    alert_float('success', data.message);
                    $('.table-game_list_t').DataTable().ajax.reload();
                } else {
                    $('#game_edit').modal('hide');
                    alert_float('danger', data.message);
                    
                }

            }
        });
    });

    $('#cat_id').change(function() {
        $('#category_casinos').empty();
        $('#sub_menus').empty();
        var sub_menu = $('#sub_menus');
        var casino_3 = $('#category_casinos');
        var cat_id = $('#cat_id').val();
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/get_sub_category/') ?>" + cat_id,
            dataType: "json",
            success: function(res) {
                $.each(res, function(k, v) {
                    if (k == 0) {
                        if (v.cat_id == '1' || v.cat_id == '2') {
                            casino_3.append('<option value="Catalog">Catalog</option>');
                            casino_3.append('<option value="Latest">Latest</option>');
                            casino_3.append('<option value="A-Z">A-Z</option>');
                        } else {
                            casino_3.append('<option value="Latest">Latest</option>');
                            casino_3.append('<option value="A-Z">A-Z</option>');
                        }
                    }
                    sub_menu.append('<option value="' + v.sub_cat_id + '">' + v.sub_cat_name + '</option>');

                });
            }
        });
    })
    $('#sub_menus').change(function() {
        $('#category_casinos').empty();
        // $('#sub_menus').empty();
        var sub_value = $('#sub_menus').val();
        var value = $('#cat_id').val();
        if (sub_value != 1 || sub_value) {
            $('#category_casinos').append('<option value="Latest">Latest</option><option value="A-Z">A-Z</option>')
        }
    })


    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-category', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/casino-category-table', undefined, undefined, service_data, [3, "desc"]);
</script>
<script>
    function on_off_switch_provider(id, status) {
        // console.log(id,status);
        $.post("<?= admin_url() . 'betting/admin/update_status_provider' ?>", {
            id: id,
            status: status
        }, function(data) {
            alert_float('success', '<?= _l('b_update_success') ?>');
            $('.table-item').DataTable().ajax.reload();
        });
    }
</script>
<script>
    function on_off_switch_type(id, status) {
        // console.log(id,status);
        $.post("<?= admin_url() . 'betting/admin/update_status_type' ?>", {
            id: id,
            status: status
        }, function(data) {
            alert_float('success', '<?= _l('b_update_success') ?>');
            $('.table-category').DataTable().ajax.reload();
        });
    }
</script>

<script>
    var service_datas = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_datas[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-item', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/casino-item-table', undefined, undefined, service_datas, [0, "asc"]);
</script>
<script>
    var service_datas = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_datas[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-game_list_t', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/game-list-table', undefined, undefined, service_datas, [0, "asc"]);
</script>
<script>
    function sync_casino(id) {

        $('#syncing').css('display', 'inline');
        $('#sync').css('display', 'none');
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/admin/sync_casino_info') ?>",
            dataType: "json",
            success: function(data) {
                //console.log(data);
                if (data.return) {
                    alert_float('success', data.message);
                    $('#sync').css('display', 'inline');
                    $('#syncing').css('display', 'none');

                } else {
                    alert_float('danger', data.message);
                    $('#sync').css('display', 'inline');
                    $('#syncing').css('display', 'none');
                }


            }
        });
    }

    function sync_by_provider(id, type_id) {
        $('#display_wati_' + id + '_' + type_id).css('display', 'inline');
        $('#sync_bttn_' + id + '_' + type_id).css('display', 'none');
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/admin/sync_game_list_info/') ?>" + id + '/' + type_id,
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data.return) {
                    $('#display_wati_' + id + '_' + type_id).css('display', 'none');
                    $('#sync_bttn_' + id + '_' + type_id).css('display', 'inline');
                    alert_float('success', data.message);
                    $('.table-game_list_t').DataTable().ajax.reload();

                } else {
                    alert_float('danger', data.message);
                    $('#display_wati_' + id + '_' + type_id).css('display', 'none');
                    $('#sync_bttn_' + id + '_' + type_id).css('display', 'inline');
                }


            }
        });
    }
</script>