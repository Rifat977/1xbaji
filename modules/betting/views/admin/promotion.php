<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Promotion</h4>

                        <hr class="hr-panel-heading">


                        <a href="#" style="margin-left: 18px;" class="btn btn-primary muster-agent">Add</a>
                        <hr>

                        <br>

                        <?php
                        $table_data = array();
                        $_table_data = array(
                            array(
                                'name' => _l('SN'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Title'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Details'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Image'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ), array(
                                'name' => _l('Link'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            ),
                            // array(
                            //     'name' => _l('Active'),
                            //     'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                            //     'tfoot' => ['class' => 'f_title']
                            // ),
                            array(
                                'name' => _l('Action'),
                                'th_attrs' => array('class' => 'toggleable', 'id' => 'th-company'),
                                'tfoot' => ['class' => 'f_title']
                            )

                        );
                        foreach ($_table_data as $_t) {
                            array_push($table_data, $_t);
                        }
                        render_datatable($table_data, 'promotion', [], [
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
<div class="_filters _hidden_inputs hidden">
    <?php
    echo form_hidden('user_id');

    ?>
</div>

<?php init_tail(); ?>


<div class="modal fade in" id="muster_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Promotion</h4>
            </div>
            <?php echo form_open_multipart();  ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Details</label>
                            <textarea class="form-control" name="address" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="images" required="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Link</label>
                            <input type="text" class="form-control" name="link" required="">
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var service_data = {};
    $.each($('._hidden_inputs._filters input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-promotion', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/promotion', undefined, undefined, service_data, [0, "asc"]);


    $('.muster-agent').click(function() {
        $('#muster_modal').modal('show');

    });

    function delete_promotion(id) {
        if (confirm("Are you sure?")) {
            $.post("<?= base_url('betting/admin/delete_promotion') ?>", {
                id: id
            }, function(data) {
                $('.table-promotion').DataTable().ajax.reload();
                alert_float('success', 'delete promotion');
            });
        } else {
            e.preventDefault();
        }
    }
</script>


</body>

</html>