<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php $website = $this->db->get(db_prefix() . 'website')->row(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 left-column">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('b_website'); ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="text-center">
                                <ul class="nav nav-tabs" role="tablist" id="myTab">
                                    <li class="active" data-toggle="tooltip" title="Header & Footer"><a href="#homePage" role="tab" data-toggle="tab">Header & Footer</a></li>
                                    <li data-toggle="tooltip" title="Slider Content"><a href="#topSlider" role="tab" data-toggle="tab">Slider</a></li>
                                    <!-- <li data-toggle="tooltip" title="Home Content"><a href="#homeContent" role="tab" data-toggle="tab">Home Content</a></li> -->
                                    <!-- <li data-toggle="tooltip" title="Casino Content"><a href="#casinoContents" role="tab" data-toggle="tab">Casino</a></li> -->
                                    <li data-toggle="tooltip" title="Currency Rate"><a href="#casinoCurrency" role="tab" data-toggle="tab">Currency Rete</a></li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="homePage">
                                    <form action="<?= admin_url('betting/admin/website_image_update') ?>" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                        <div class="login-section">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?= render_input('login_bg_img', 'Login Page Background Image', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('website_bg_img', 'Wibsite Background Image', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('sign_up_banner', 'Sign Up Banner', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <img style="height:250px; width:100%;" src="<?= isset($website) ? base_url('modules/betting/upload/website/' . $website->login_bg_img) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-4">
                                                    <img style="height:250px; width:100%;" src="<?= isset($website) ? base_url('modules/betting/upload/website/' . $website->website_bg_img) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-4">
                                                    <img style="height:250px; width:100%;" src="<?= isset($website) ? base_url('modules/betting/upload/website/' . $website->sign_up_banner) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary mright5"> Update </button>
                                        </div>
                                    </form>
                                    <div class="header-div">
                                        <form action="<?= admin_url('betting/admin/header_update') ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div class="row mtop10">
                                                <div class="col-md-12">
                                                    <h3 class="text-center">Header Section</h3>
                                                </div>
                                                <div class="col-md-12">
                                                    <div>header</div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="Header">
                                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="a_" data-id="" onchange="status_update(this, 'header_status')" <?= isset($website) && $website->header_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="a_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-11">
                                                    <?= render_input('header_logo', 'Logo', '', 'file', []) ?>

                                                </div>
                                                <div class="col-md-1">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/' . $website->header_logo) : '#' ?>" alt="" class="img-responsive mtop15">
                                                </div>
                                                <div class="col-md-12">
                                                    <?php $marquee = isset($website) ? $website->marquee : '' ?>
                                                    <?= render_textarea('marquee', 'Marquee', $marquee, ['id' => 'marquee']) ?>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary mright5">
                                                    Update </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footer-div">
                                        <h3 class="text-center">Footer Section</h3>
                                        <h5 class="text-center"> <a target="_blank" href="https://fontawesome.com/search?q=facebook&o=r&m=free"><i class="fa-solid fa-circle-info mright5"></i>Find icon</a></h5>
                                        <form action="<?= admin_url('betting/admin/footer_update') ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div class="col-md-12 text-center">
                                                <div>Footer</div>
                                                <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="Footer">
                                                    <input type="checkbox" class="onoffswitch-checkbox" id="fo_" onchange="status_update(this, 'footer_status')" <?= isset($website) && $website->footer_status == 1 ?  'checked' : '' ?>>
                                                    <label class="onoffswitch-label" for="fo_"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_1', '<i class="fa-solid fa-paper-plane mright5"></i>Icon 1', isset($website) ? $website->social_icon_1 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_1_link', 'Icon 1 Link', isset($website) ? $website->social_icon_1_link : '', 'url') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_2', '<i class="fa-brands fa-whatsapp mright5"></i>Icon 2', isset($website) ? $website->social_icon_2 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_2_link', 'Icon 2 link', isset($website) ? $website->social_icon_2_link : '', 'url') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_3', '<i class="fa-brands fa-facebook-f mright5"></i>Icon 3', isset($website) ? $website->social_icon_3 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('social_icon_3_link', 'Icon 3 link', isset($website) ? $website->social_icon_3_link : '', 'url') ?>
                                            </div>
                                            <div class="col-md-12">
                                                <h3 class="text-center">Footer Menu</h3>
                                            </div>

                                            <div class="col-md-6">
                                                <?= render_input('footer1', 'Name 1', isset($website) ? $website->footer1 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_textarea('footer1_details', 'Discription 1', isset($website) ? $website->footer1_details : '') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('footer2', 'Name 2', isset($website) ? $website->footer2 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_textarea('footer2_details', 'Discription 2', isset($website) ? $website->footer2_details : '') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('footer3', 'Name 3', isset($website) ? $website->footer3 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_textarea('footer3_details', 'Discription 3', isset($website) ? $website->footer3_details : '') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('footer4', 'Name 4', isset($website) ? $website->footer4 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_textarea('footer4_details', 'Discription 4', isset($website) ? $website->footer4_details : '') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_input('footer5', 'Name 5', isset($website) ? $website->footer5 : '', 'text') ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?= render_textarea('footer5_details', 'Discription 5', isset($website) ? $website->footer5_details : '') ?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary ">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <!-- Top Slider  -->
                                <div class="tab-pane" id="topSlider">
                                    <h3 class="text-center">Top Slider</h3>

                                    <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                        <button type="button" class="btn btn-primary mright5 add_slider" data-toggle="tooltip" title="Add Slider">
                                            <i class="fa-regular fa-plus tw-mr-1"></i> Add Slider </button>
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
                                            'name' => _l('b_image'),
                                            'th_attrs' => array('class' => 'toggleable', 'id' => 'th-primary-contact-email', 'style' => 'width:150px'),
                                            'tfoot' => []
                                        ),
                                        array(
                                            'name' => _l('b_url'),
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
                                    render_datatable($table_data, 'slider', [], [
                                        'data-last-order-identifier' => 'customers',
                                        'data-default-order'         => get_table_last_order('customers'),
                                    ]);
                                    ?>


                                </div>

                                <div class="tab-pane" id="homeContent">
                                    <div>
                                        <h3 class="text-center">Home content</h3>
                                        <h5 class="text-center"> <a data-toggle="tooltip" title="Find Font Awesome Icon" target="_blank" href="https://fontawesome.com/search?o=r&m=free"><i class="fa-solid fa-circle-info mright5"></i>Find icon</a></h5>
                                        <form action="<?= admin_url('betting/admin/update_home_content') ?>" method="POST">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->sports_name : '' ?></div>
                                                        <div class="onoffswitch text-center mtop10" data-toggle="tooltip" title="<?= isset($website) ? $website->sports_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" onchange="status_update(this, 'sports_status')" id="f_" data-id="" <?= isset($website) && $website->sports_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="f_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('sports_logo', isset($website) ? $website->sports_logo . ' Logo' : "Logo", isset($website) ? $website->sports_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('sports_name', 'Name', isset($website) ? $website->sports_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->live_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->live_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="g_" data-id="" onchange="status_update(this, 'live_status')" <?= isset($website) && $website->live_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="g_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('live_logo', isset($website) ? $website->live_logo . ' Logo' : "Logo", isset($website) ? $website->live_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('live_name', 'Name', isset($website) ? $website->live_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->table_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->table_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="h_" data-id="" onchange="status_update(this, 'table_status')" <?= isset($website) && $website->table_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="h_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('table_logo', isset($website) ? $website->table_logo . ' Logo' : "Logo", isset($website) ? $website->table_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('table_name', 'Name', isset($website) ? $website->table_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->slot_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->slot_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="i_" data-id="" onchange="status_update(this, 'slot_status')" <?= isset($website) && $website->slot_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="i_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('slot_logo', isset($website) ? $website->slot_logo . ' Logo' : "Logo", isset($website) ? $website->slot_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('slot_name', 'Name', isset($website) ? $website->slot_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->fishing_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->fishing_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="p_" data-id="" onchange="status_update(this, 'fishing_status')" <?= isset($website) && $website->fishing_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="p_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('fishing_logo', isset($website) ? $website->fishing_logo . ' Logo' : "Logo", isset($website) ? $website->fishing_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('fishing_name', 'Name', isset($website) ? $website->fishing_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->egame_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->egame_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="j_" data-id="" onchange="status_update(this, 'egame_status')" <?= isset($website) && $website->egame_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="j_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('egame_logo', isset($website) ? $website->egame_logo . ' Logo' : "Logo", isset($website) ? $website->egame_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('egame_name', 'Name', isset($website) ? $website->egame_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->inplay_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->inplay_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="k_" data-id="" onchange="status_update(this, 'inplay_status')" <?= isset($website) && $website->inplay_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="k_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('inplay_logo', isset($website) ? $website->inplay_logo . ' Logo' : "Logo", isset($website) ? $website->inplay_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('inplay_name', 'In-play Name', isset($website) ? $website->inplay_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->today_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->today_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="l_" data-id="" onchange="status_update(this, 'today_status')" <?= isset($website) && $website->today_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="l_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('today_logo', isset($website) ? $website->today_logo . ' Logo' : "Logo", isset($website) ? $website->today_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('today_name', 'Today Name', isset($website) ? $website->today_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->tomorrow_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->tomorrow_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="m_" data-id="" onchange="status_update(this, 'tomorrow_status')" <?= isset($website) && $website->tomorrow_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="m_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('tomorrow_logo', isset($website) ? $website->tomorrow_logo . ' Logo' : "Logo", isset($website) ? $website->tomorrow_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('tomorrow_name', 'Tomorrow Name', isset($website) ? $website->tomorrow_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->league_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->league_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="n_" data-id="" onchange="status_update(this, 'league_status')" <?= isset($website) && $website->league_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="n_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('league_logo', isset($website) ? $website->league_logo . ' Logo' : "Logo", isset($website) ? $website->league_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('league_name', 'League Name', isset($website) ? $website->league_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><?= isset($website) ? $website->parlay_name : '' ?></div>
                                                        <div class="onoffswitch" data-toggle="tooltip" title="<?= isset($website) ? $website->parlay_name : '' ?>">
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="o_" data-id="" onchange="status_update(this, 'parlay_status')" <?= isset($website) && $website->parlay_status == 1 ?  'checked' : '' ?>>
                                                            <label class="onoffswitch-label" for="o_"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('parlay_logo', isset($website) ? $website->parlay_logo . ' Logo' : "Logo", isset($website) ? $website->parlay_logo : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <?= render_input('parlay_name', 'Parlay Name', isset($website) ? $website->parlay_name : '', 'text', []) ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                                    <button type="submit" class="btn btn-primary mright5"> Update </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="tab-pane" id="casinoContents">
                                    <div>
                                        <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                            <a data-toggle="tooltip" title="Casino Content" href="<?= admin_url('betting/admin/casino_info') ?>" class="btn btn-primary mright5">Casino Content</a>
                                        </div>
                                        <!-- <h5 class="text-center"> <a target="_blank" href="https://fontawesome.com/search?q=facebook&o=r&m=free"><i class="fa-solid fa-circle-info mright5"></i>Find icon</a></h5> -->
                                        <form action="<?= admin_url('betting/admin/casino_update') ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                            <div class="row">
                                                <h3 class="text-center">Casino Tab </h3>
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_1_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_1_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="po_" data-id="" onchange="status_update(this, 'casino_logo_1_status')" <?= isset($website) && $website->casino_logo_1_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="po_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_1', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_1) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_1_name', 'Name', isset($website) ?  $website->casino_logo_1_name : '', 'text', []) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- <h3 class="text-center">Casino Tab 2</h3> -->
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_2_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_2_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="li_" data-id="" onchange="status_update(this, 'casino_logo_2_status')" <?= isset($website) && $website->casino_logo_2_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="li_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_2', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_2) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_2_name', 'Name', isset($website) ?  $website->casino_logo_2_name : '', 'text', []) ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- <h3 class="text-center">Casino Tab 3</h3> -->
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_3_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_3_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="ta_" data-id="" onchange="status_update(this, 'casino_logo_3_status')" <?= isset($website) && $website->casino_logo_3_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="ta_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_3', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_3) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_3_name', 'Name', isset($website) ?  $website->casino_logo_3_name : '', 'text', []) ?>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <!-- <h3 class="text-center">Casino Tab 4</h3> -->
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_4_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_4_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="so_" data-id="" onchange="status_update(this, 'casino_logo_4_status')" <?= isset($website) && $website->casino_logo_4_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="so_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_4', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_4) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_4_name', 'Name', isset($website) ?  $website->casino_logo_4_name : '', 'text', []) ?>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <!-- <h3 class="text-center">Casino Tab 5</h3> -->
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_5_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_5_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="fis_" data-id="" onchange="status_update(this, 'casino_logo_5_status')" <?= isset($website) && $website->casino_logo_5_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="fis_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_5', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_5) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_5_name', 'Name', isset($website) ?  $website->casino_logo_5_name : '', 'text', []) ?>
                                                </div>
                                                <!-- <div class="col-md-12">
                                                    <h4 class="text-center">Fishing Tabs</h4>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-1">
                                                    <div>Fishing tabs 1</div>
                                                    <div class="onoffswitch mtop10 text-center">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="fishing_tabs1" data-id="">
                                                        <label class="onoffswitch-label" for="fishing_tabs1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('fishing_spade_name', 'Fishing tab 1', '', 'text', []) ?>
                                                </div>
                                                <div class="col-md-1">
                                                    <div>Fishing tabs 2</div>
                                                    <div class="onoffswitch mtop10 text-center">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="fishing_tabs2" data-id="">
                                                        <label class="onoffswitch-label" for="fishing_tabs2"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('fishing_jili_name', 'Fishing tab 2', '', 'text', []) ?>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <!-- <h3 class="text-center">Casino Tab 6</h3> -->
                                                <div class="col-md-2">
                                                    <div><?= isset($website) ?  $website->casino_logo_6_name : '' ?></div>
                                                    <div class="onoffswitch mtop10 text-center" data-toggle="tooltip" title="<?= isset($website) ?  $website->casino_logo_6_name : '' ?>">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="egame_" data-id="" onchange="status_update(this, 'casino_logo_6_status')" <?= isset($website) && $website->casino_logo_6_status == 1 ?  'checked' : '' ?>>
                                                        <label class="onoffswitch-label" for="egame_"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('casino_logo_6', 'Logo (53x50)', '', 'file', []) ?>
                                                </div>
                                                <div class="col-md-1 mtop15">
                                                    <img src="<?= isset($website) ? base_url('modules/betting/upload/website/casino/' . $website->casino_logo_6) : '#' ?>" alt="" class="img-responsive">
                                                </div>
                                                <div class="col-md-5">
                                                    <?= render_input('casino_logo_6_name', 'Name', isset($website) ?  $website->casino_logo_6_name : '', 'text', []) ?>
                                                </div>
                                                <!-- <div class="col-md-12">
                                                    <h4 class="text-center">Egame Tabs</h4>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-1">
                                                    <div>Egame tabs 1</div>
                                                    <div class="onoffswitch mtop10 text-center">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="egame_tabs1" data-id="">
                                                        <label class="onoffswitch-label" for="egame_tabs1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('egame_pp_name', 'Fishing tab 1', '', 'text', []) ?>
                                                </div>
                                                <div class="col-md-1">
                                                    <div>Egame tabs 2</div>
                                                    <div class="onoffswitch mtop10 text-center">
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="egame_tabs2" data-id="">
                                                        <label class="onoffswitch-label" for="egame_tabs2"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <?= render_input('egame_jdb_name', 'Fishing tab 2', '', 'text', []) ?>
                                                </div> -->
                                            </div>
                                            <div class="modal-footer">
                                                <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                                    <button type="submit" class="btn btn-primary mright5"> Update </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="casinoCurrency">
                                    <h3 class="text-center">Currency Rate</h3>
                                    <div class="_buttons tw-mb-2 sm:tw-mb-4">
                                        <button data-toggle="tooltip" title="Change Currency Rate" type="button" class="btn btn-primary mright5 currency-rate">Change Currency Rate</button>
                                        <button data-toggle="tooltip" title="Change Currency Rate" type="button" class="btn btn-secondary mright5 currency-set">Set Currency Rate</button>
                                    </div>

                                    <div class="" id="currency_veiw">
                                        <?php
                                        $currencies = $this->db->get_where(db_prefix() . 'currencies', ['isdefault' => 0])->result();

                                        foreach ($currencies as $k => $c) { ?>
                                            <p><span>1 USD = </span><span id="change_price<?= $c->id ?>"><?= $c->price_value ?></span> <?= $c->name ?></p>
                                        <?php }
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
</div>


<?php $this->load->view($modal) ?>
<?php $this->load->view($modal2) ?>
<?php $this->load->view($modal3) ?>

<?php init_tail(); ?>

<script>
    function status_update(id, name) {
        var input = id.attributes;
        var value = 0;
        if ($(id).prop('checked')) {
            value = 1;
        } else {
            value = 0;
        }
        bet.common_status('<?= admin_url('betting/admin/website_status/') ?>' + value + '/' + name);
    }


    $('.add_slider').click(function(e) {
        e.preventDefault();
        $('#sliderModal').modal('show');
        $('#imagePreview').attr('src', '').hide();
        $('#slider_id').val('0');
        $('#slider_url').val('');
        $('#image').val('');
    });

    $('.currency-rate').click(function() {
        $('#currencyModal').modal('show');
        $('#currency_rate_form').trigger('reset');
    });
    $('.currency-set').click(function() {

        $('#currencysetModal').modal('show');
        $('#currency_set_form').trigger('reset');
    });

    $('#currency_id').change(function() {
        var curr = $('#currency_id').val();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/current_currency_rate') ?>",
            data: {
                curr: curr,
            },
            dataType: "json",
            success: function(data) {
                data.forEach(function(e) {
                    $('#price[' + e.id + ']').value(e.price_value);
                })
                // if (data.id != 1) {
                //     var message = 'Current Rate $1 = ' + data.symbol + ' ' + data.price_value;
                //     $('.current_currency_rate').html(message);
                // } else {
                //     $('.current_currency_rate').html('');

                // }
            }
        });
    });
    $('#currency_id').click(function() {
        $(this).trigger('reset');
    })

    $('#currency_rate_form').submit(function(e) {
        e.preventDefault();
        var id = $('#currency_rate_form #currency_id').val();
        $.ajax({
            type: "post",
            url: "<?= base_url('betting/admin/currency_rate_update') ?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                // console.log(data);
                // $('#change_price' + id).html(data);
                window.location.reload();
                 alert_float('success', '<?= _l('b_update_success') ?>');
                // $('#currencyModal').modal('hide');

            }
        });
    });

    $('#image').change(function() {
        var curElement = $('#imagePreview');
        console.log(this);
        var reader = new FileReader();
        reader.onload = function(e) {
            curElement.attr('src', e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });


    function slider_edit(id, image, slider_url) {
        $('#sliderModal').modal('show');
        $('#image').val('');
        if (image != '') {
            $('#imagePreview').attr('src', image).show();
        } else {
            $('#imagePreview').attr('src', '#').hide();
        }
        $('#slider_id').val(id);
        $('#slider_url').val(slider_url);
    }


    $('#slider_form').submit(function(e) {
        e.preventDefault();
        var id = $('#id').val();
        $.ajax({
            type: "post",
            url: "<?= admin_url('betting/admin/slider_add') ?>",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                // window.location.reload();
                $('#sliderModal').modal('hide');
                $('.table-slider').DataTable().ajax.reload();
                if (data != false) {
                    alert_float('success', data);
                }
            }
        });
    });


    function delete_slider(slider_id, image) {
        if (confirm('Are you sure?')) {
            $.ajax({
                type: "post",
                url: "<?= admin_url('betting/admin/delete_slider/') ?>" + slider_id + '/' + image,
                dataType: "json",
                success: function(data) {
                    $('#sliderModal').modal('hide');
                    $('.table-slider').DataTable().ajax.reload();
                    if (data != false) {
                        alert_float('success', data);
                    }
                }
            });
        }
    }
    var service_data = {};
    $.each($('._hidden_inputs2._filters2 input'), function() {
        service_data[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
    });
    initDataTable('.table-slider', admin_url + '<?= BETTING_MODULE_NAME ?>/admin/sports_table/slider-table', undefined, undefined, service_data, [0, "asc"]);
</script>

</body>

</html>