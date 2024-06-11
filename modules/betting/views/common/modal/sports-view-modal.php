<div class="modal fade lead-modal" id="sports_view_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="sports_view_modal"><?= _l('b_view') . ' ' . _l('b_sports') ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">



                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#auto" aria-controls="auto" role="tab" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i> <?= _l('b_auto') ?></a></li>
                    <li role="presentation"><a href="#manual" aria-controls="manual" role="tab" data-toggle="tab"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?= _l('b_manual') ?></a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="auto">


                        <div class="row">
                            <div class="col-md-12 align-right">
                                <button class="btn btn-info" onclick="bet.sync('bet',{id:<?= $sports->id ?>})"><i class="fa fa-sync"></i></button>
                            </div>

                            <div class="col-md-12">

                                <?php
                                if (strlen($sports->history) > 0 && $sports->history != '[]') {
                                    $history = json_decode($sports->history);
                                    $manual =  strlen($sports->manual) > 0 && $sports->manual != '[]' ? json_decode($sports->manual) : [];
                                    if (isset($history->output->data)) {
                                        foreach ($history->output->data as $i1 => $b) {
                                            echo '<h4>' . ($i1 + 1) . '. ' . $b->sport_title . ' (' . $b->home_team . ' VS ' . $b->away_team . ') <a href="#" onclick="bet.manual(\'' . $b->id . '\',\'' . $b->sport_key . '\',' . $sports->id . ')" ><i class="fa fa-plus"></i></a><br><sub>' . $b->commence_time . '</sub></h4>';

                                            foreach ($b->bookmakers as $i2 => $m) {
                                                echo '<h5><u>' . $m->title . '</u> <sub style="color:green;">(Odds)</sub></h5>';
                                                foreach ($m->markets as $i3 => $o) {
                                                    echo '<ul style="margin-left:20px;">';
                                                    foreach ($o->outcomes as $i4 => $bet) {
                                                        echo '<li>' . ($i4 + 1) . '. ' . $bet->name . ' <b>(' . $bet->price . ')</b> <sub>price</sub></li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                            }
                                            if (!empty($manual)) {
                                                foreach ($manual as $m_id => $b2) {
                                                    if ($b2->id == $b->id) {
                                                        foreach ($b2->bookmakers as $i5 => $m2) {
                                                            echo '<a href="#" data-toggle="tooltip" data-original-title="Delete (' . $m2->title . ')" onclick="bet.del_bookmark(' . $sports->id . ',' . $m_id . ',' . $i5 . ')" style="color:red;"><i class="fa fa-trash"></i></a> <a  href="#"><i class="fa fa-pencil" onclick="bet.edit_bookmark(' . $sports->id . ',' . $m_id . ',' . $i5 . ',\'' . $m2->title . '\')"></i></a><h5><u>' . $m2->title . '</u> <sub style="color:red;">(Manual)</sub></h5>';
                                                            echo '<ul style="margin-left:20px;">';
                                                            foreach ($m2->markets as $i6 => $o2) {
                                                                echo '<li><a data-toggle="tooltip" data-original-title="Delete (' .  $o2->name . ')" onclick="bet.del_market(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ')" href="#" style="color:red;"><i class="fa fa-trash"></i></a> ' . ($i6 + 1) . '. ' . $o2->name . ' <b>(' . $o2->price . ')</b> <sub>price</sub>  <a onclick="bet.edit_market(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ',\'' . $o2->name . '\')" href="#"><i class="fa fa-pencil"></i></a>  <a style="color:green;" onclick="bet.edit_market_price(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ',\'' . $o2->price . '\')" href="#"><i class="fa fa-dollar"></i></a></li>';
                                                            }
                                                            echo '</ul>';
                                                        }
                                                    }
                                                }
                                            }
                                            echo '<hr>';
                                        }
                                    }
                                }
                                ?>

                            </div>


                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="manual">
                        <?php if (!empty($manual)) { ?>
                            <div class="col-md-12" style="text-align: right;">
                                <button class="btn btn-danger" onclick="bet.sync('delete',{id:<?= $sports->id ?>})"><i class="fa fa-trash"></i> Delete All</button>
                            </div>
                        <?php } ?>
                        <?php

                        if (!empty($manual)) {
                            foreach ($manual as $m_id => $b2) {
                                //$index = array_search()
                                echo '<h6>' . $b2->sport_key . ' <sub>' . $b2->id . '</sub></h6>';
                                // if ($b2->id == $b->id) {
                                foreach ($b2->bookmakers as $i5 => $m2) {
                                    echo '<a href="#" data-toggle="tooltip" data-original-title="Delete (' . $m2->title . ')" onclick="bet.del_bookmark(' . $sports->id . ',' . $m_id . ',' . $i5 . ')" style="color:red;"><i class="fa fa-trash"></i></a> <a  href="#"><i class="fa fa-pencil" onclick="bet.edit_bookmark(' . $sports->id . ',' . $m_id . ',' . $i5 . ',\'' . $m2->title . '\')"></i></a><h5><u>' . $m2->title . '</u> <sub style="color:red;">(Manual)</sub></h5>';
                                    echo '<ul style="margin-left:20px;">';
                                    foreach ($m2->markets as $i6 => $o2) {
                                        echo '<li><a data-toggle="tooltip" data-original-title="Delete (' .  $o2->name . ')" onclick="bet.del_market(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ')" href="#" style="color:red;"><i class="fa fa-trash"></i></a> ' . ($i6 + 1) . '. ' . $o2->name . ' <b>(' . $o2->price . ')</b> <sub>price</sub>  <a onclick="bet.edit_market(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ',\'' . $o2->name . '\')" href="#"><i class="fa fa-pencil"></i></a>  <a style="color:green;" onclick="bet.edit_market_price(' . $sports->id . ',' . $m_id . ',' . $i5 . ',' . $i6 . ',\'' . $o2->price . '\')" href="#"><i class="fa fa-dollar"></i></a></li>';
                                    }
                                    echo '</ul>';
                                }
                                //}
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <!-- <button type="submit" class="btn btn-primary"><?= _l('b_save') ?></button> -->

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade lead-modal" id="sports_manual_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog ">
        <div class="modal-content data">
            <div class="modal-header">
                <h3 class="modal-title" style="display:inline;" id="sports_view_modal"><?= _l('b_add_item')  ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="sports_id">
                <input type="hidden" id="sports_key">
                <input type="hidden" id="bet_id">

                <div class="row">


                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="title">
                            <label for="title" class="control-label"><?= _l("b_title") ?></label>
                            <input type="text" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="name">
                            <label for="name" class="control-label"><?= _l("b_name") ?></label>
                            <input type="text" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="price">
                            <label for="price" class="control-label"><?= _l("b_price") ?></label>
                            <input type="number" step="0.00" id="price" class="form-control">
                        </div>
                    </div>

                </div>



            </div>
            <div class="modal-footer">

                <button type="submit" onclick="bet.manual_save()" class="btn btn-primary"><?= _l('b_save') ?></button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= _l('b_close') ?></button>
            </div>

        </div>
    </div>
</div>