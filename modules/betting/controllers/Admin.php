<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('betting_model');
        $this->load->model('corn_model');
        $this->load->model('contracts_model');
    }

    public function bashboard()
    {
        $data['title'] = _l("b_dashboard");
        $this->load->view('admin/dashboard', $data);
    }

    public function delete_promotion()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('tblbet_promotion');
        echo true;
    }
    public function change_commision()
    {
        $data = $this->input->post();
        $this->db->where('staffid', $data['id']);
        $this->db->update('tblstaff', ['commission' => $data['com']]);
        echo true;
    }
    public function agent_commision_set()
    {
        $data['title'] = _l("Agent Commision Set");
        $this->load->view('admin/agent_commision_set', $data);
    }
    public function theme()
    {
        $data['title'] = _l("b_theme");
        $this->load->view('admin/theme', $data);
    }
    public function get_agent()
    {
        $agent_info = [];
        $client = $this->db->get_where('tblclients', ['default_currency' => $this->input->post('c_id')])->result();
        foreach ($client as $key) {
            $agent = $this->db->get_where('tblcontacts', ['userid' => $key->userid])->result();
            array_push($agent_info, $agent);
        }
        echo json_encode($agent_info);
    }

    public function commision_accepet()
    {
        if (!is_admin()) {
            echo json_encode(['return' => false, 'message' => 'need to admin request.']);
            die;
        }
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tblbet_agent_comission_withdraw', [
            'status' => 1,
            'approved_by' => get_staff_user_id()
        ]);
        echo json_encode(['return' => true, 'message' => 'withdraw completed.']);
    }
    public function commision_reject()
    {
        if (!is_admin()) {
            echo json_encode(['return' => false, 'message' => 'need to admin request.']);
            die;
        }
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tblbet_agent_comission_withdraw', [
            'status' => 2,
            'approved_by' => get_staff_user_id()
        ]);
        echo json_encode(['return' => true, 'message' => 'withdraw rejected.']);
    }

    public function promotion()
    {

        if ($this->input->post()) {
            $data = $this->input->post();
            $filename = $_FILES['images']['name'];
            $files = '';

            if ($filename != '') {
                $path = 'modules/betting/upload/promotion/';
                $upload_file = '';

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $config = [
                    'upload_path' => $path,
                    'allowed_types' => 'gif|jpg|png|webp|jpeg',
                    'encrypt_name' => true,
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('images')) {
                    $upload_file = $this->upload->data('file_name');
                    $files = $upload_file;
                }
            }
            $this->db->insert('tblbet_promotion', [
                'image' =>  $files,
                'title' =>  $data['title'],
                'details' => $data['address'],
                'link' => $data['link'],
            ]);
            set_alert('success', 'promotion added.');
            redirect(admin_url('betting/admin/promotion'));
        }
        $data['title'] = _l("Promotion");
        $this->load->view('admin/promotion', $data);
    }

    public function website()
    {
        $data['title'] = _l("b_website");
        $data['modal'] = 'common/modal/slider-modal';
        $data['modal2'] = 'common/modal/currency-rete-modal';
        $data['modal3'] = 'common/modal/set-currency-modal';
        $this->load->view('admin/website', $data);
    }

    public function agent_withdraw()
    {

        if ($this->input->post()) {
            $data = $this->input->post();
            if (!is_admin()) {
                $this->db->where('staff_id', get_staff_user_id());
            }
            $commission = $this->db->select('SUM(usd_amount_commission) AS amount')->get_where('tblbet_agent_comission')->row()->amount;

            if (!is_admin()) {
                $this->db->where('staff_id', get_staff_user_id());
            }
            $withrow = $this->db->select('SUM(amount) AS amount')->get_where('tblbet_agent_comission_withdraw')->row()->amount;
            $balance = $commission -  $withrow;
            if ($balance >= $data['amount']) {
                $this->db->insert('tblbet_agent_comission_withdraw', [
                    'staff_id' => get_staff_user_id(),
                    'amount' => $data['amount'],
                    'address' => $data['address']
                ]);
                set_alert('success', 'withdraw completed. wait for admin approved.');
                redirect(admin_url('betting/admin/agent_withdraw'));
            } else {
                set_alert('danger', 'Please type currect amount.');
                redirect(admin_url('betting/admin/agent_withdraw'));
            }
        }
        $data['title'] = 'Commission Details';
        $this->load->view('admin/agent_withdraw', $data);
    }

    public function master_agent_add()
    {
        $data['title'] = 'Master Agent Add';
        $data['muster_agent'] = 'common/modal/add-muster-modal';
        $this->load->view('admin/master_agent_add', $data);
    }

    public function add_muster_agent()
    {
        $data = $this->input->post();

        $insert_id = $this->staff_model->add($data);
        if ($insert_id) {
            handle_staff_profile_image_upload($insert_id);
        }
        $create = get_staff_user_id();
        $this->db->where('staffid', $insert_id);
        $result = $this->db->update('tblstaff', ['create_by' => $create]);
        if ($result) {

            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'contracts', 'capability' => 'view_own']);
            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'contracts', 'capability' => 'create']);
            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'contracts', 'capability' => 'edit']);
            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'customers', 'capability' => 'create']);
            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'customers', 'capability' => 'edit']);
            $this->db->insert('tblstaff_permissions', ['staff_id' => $insert_id, 'feature' => 'betting-agent-widthraw', 'capability' => 'view']);


            set_alert('success', _l('added_successfully', _l('master_agent')));
            redirect(admin_url('betting/admin/master_agent_add'));
        }
    }
    public function agent_release()
    {
        if (!is_admin()) {
            set_alert('danger',  'You don\'t have admin access');
            redirect(admin_url());
        }
        $data['title'] = 'Agent Commision Release';
        $this->load->view('admin/agent_release', $data);
    }

    public function category()
    {
        $data['title'] = _l("b_category");
        $data['modal'] = 'common/modal/category-add-modal';
        $this->load->view('admin/category', $data);
    }

    public function sports()
    {
        $data['category'] = $this->betting_model->category();
        $data['group'] = $this->betting_model->odds_group();
        $data['title'] = _l("b_sports");
        $this->load->view('admin/sports', $data);
    }

    public function add_sports()
    {
        $return = $this->betting_model->add_sports($this->input->post());
        if ($return) {
            set_alert('success',  _l('b_success_save'));
        } else {
            set_alert('danger',  _l('b_already_have'));
        }

        redirect(admin_url('betting/admin/sports'));
    }

    public function update_sports($id)
    {
        $return = $this->betting_model->update_sports($id, $this->input->post());
        if ($return) {
            set_alert('success',  _l('b_update_success'));
        } else {
            set_alert('danger',  _l('b_already_have'));
        }
        redirect(admin_url('betting/admin/sports'));
    }

    public function modal($type)
    {
        switch ($type) {
            case BETTING_ODDS:
                $key = $this->input->post('id');
                $data['id'] = $key;
                $data['category'] = $this->betting_model->category();
                $data['type'] = BETTING_ODDS;
                $data['name'] = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['sports'] = $this->betting_model->odds_sports($key);
                $data['bet_actived'] = $this->betting_model->odds_actived($key);
                echo json_encode([
                    'data'          => $this->load->view('common/modal/sports-add-modal', $data, true),
                    'return' => true,
                    'message' => _l('b_sync_done')
                ]);
                break;
            case  'viewBet':
                $data['sports'] =  $this->db->get_where(db_prefix() . 'betting', ['id' => $this->input->post('id')])->row();
                echo json_encode([
                    'data'   => $this->load->view('common/modal/sports-view-modal', $data, true),
                    'return' => true,
                    'message' => _l('b_sync_done')
                ]);
                break;
            case 'menualBet':
                $data['sports'] =  $this->db->get_where(db_prefix() . 'betting', ['id' => $this->input->post('id')])->row();
                echo json_encode([
                    'data'   => $this->load->view('common/modal/sports-view-modal', $data, true),
                    'return' => true,
                    'message' => _l('b_sync_done')
                ]);
                break;
            case 'winLoss':
                $data =  $this->corn_model->userbet($this->input->post());
                echo json_encode([
                    'data'   => $this->load->view('common/modal/winLoss-modal', $data, true),
                    'return' => true,
                    'message' => _l('b_sync_done')
                ]);
                break;
            default:
                echo json_encode(['return' => false, 'message' => _l('b_sync_default'), 'data' => []]);
                break;
        }
    }
    public function apply()
    {
        echo json_encode($this->corn_model->apply($this->input->post()));
    }
    public function agent_commission()
    {
        $data['commission'] =  $this->db->get_where(db_prefix() . 'contacts', ['id' => $this->input->post('id')])->row();
        echo json_encode([
            'data'   => $this->load->view('common/modal/agent_commission', $data, true),
            'return' => true,
            'message' => _l('b_sync_done')
        ]);
    }
    public function view_history()
    {
        $data['commission'] =  $this->db->get_where(db_prefix() . 'contacts', ['id' => $this->input->post('id')])->row();
        echo json_encode([
            'data'   => $this->load->view('common/modal/agent-history-show-model', $data, true),
            'return' => true,
            'message' => _l('b_sync_done')
        ]);
    }
    public function commission_hisory()
    {
        $data['title'] = _l('b_agent') . ' ' . _l('b_commission');
        $this->load->view('admin/commission_history', $data);
    }
    public function affiliate_withdrow()
    {
        $data['title'] = _l('affiliate_w');
        $this->load->view('admin/affiliate_withdrow', $data);
    }
    public function add_agent_history()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $insert = [
                'balance' => $data['balance'],
                'remark' => $data['remark'],
                'agent_id' => $data['id'],
                'create_at' => get_staff_user_id(),
            ];
            $result = $this->db->insert('tblagent_history', $insert);
            if ($result) {
                echo json_encode(['return' => true]);
            }
        }
    }
    public function sports_table($table)
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data(module_views_path(BETTING_MODULE_NAME, 'common/table/' . $table));
        }
    }

    public function update_agent_commission()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $data['id']);
            $result = $this->db->update('contacts', ['agent_deposit' => $data['deposit'], 'agent_withdrow' => $data['withdrow']]);
            if ($result) {
                echo json_encode(['return' => true]);
            } else {
                echo json_encode(['return' => false]);
            }
        }
    }
    public function update_status()
    {
        $data = $this->input->post();
        $this->db->where('id', $data['bet_id']);
        $result = $this->db->update('tblbetting', ['is_active' => (($data['status'] == true) ? 0 : 1)]);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }
    public function update_status_provider()
    {
        $data = $this->input->post();
        $this->db->where('id', $data['id']);
        $result = $this->db->update('tblbet_provider', ['is_active' => (($data['status'] == true) ? 0 : 1)]);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }
    public function update_status_type()
    {
        $data = $this->input->post();
        $this->db->where('id', $data['id']);
        $result = $this->db->update('tblbet_game_type', ['is_active' => (($data['status'] == true) ? 0 : 1)]);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }

    public function commission_relise()
    {
        $agent_info = $this->db->get_where(db_prefix() . 'contacts', ['active' => 1])->result();

        //echo json_encode($agent_info);
        if ($agent_info) {
            $deposit_balance = 0;
            foreach ($agent_info as $key) {
                //deposit commission by super agent
                //deposit commission by move cash/normal agent
                $this->db->select_sum('amount');
                $deposit_balance = $this->db->get_where('tbldeposit_history', ['contact_id' => $key->id, 'is_commission' => 0, 'status' => 1])->row()->amount;
                $dm = (($key->agent_deposit * $deposit_balance) / 100);
                if ($dm > 0) {
                    $deposit = [
                        'agent_id' => $key->id,
                        'balance' => $dm,
                        'remark' => '(Monthly) Deposit Commission',
                        'create_at' => get_staff_user_id(),
                        'is_commission' => 1
                    ];
                    $this->db->insert('tblagent_history', $deposit);
                    $this->db->where('contact_id', $key->id)->update(db_prefix() . 'deposit_history', ['is_commission' => 1]);
                }

                $master_agent = $this->db->get_where(db_prefix() . 'staff', ['staffid' => $key->create_by, 'active' => 1])->row();
                if (!empty($master_agent)) {
                    //deposit commission by master agent
                    $master_commission = $master_agent->commission; // get_option('bet_master_agent_commission');
                    $deposit_balance = $this->db->select('sum(balance) as amount')->get_where('tblagent_history', ['agent_id' => $key->id, 'is_commission' => 0])->row()->amount;
                    if ($deposit_balance > 0) {
                        echo  $key->id . ' - ' .  $deposit_balance . '<br>';
                        $this->db->where('agent_id', $key->id);
                        $this->db->update('tblagent_history', ['is_commission' => 1]);
                        $commission_amount = (($master_commission * $deposit_balance) / 100);
                        $local_currency = $this->db->get_where(db_prefix() . 'clients', ['userid' => $key->userid])->row();
                        $c_amount = $this->db->get_where(db_prefix() . 'currencies', ['id' => $local_currency->default_currency])->row();
                        $usd_amount = $commission_amount / $c_amount->price_value;
                        //master agent
                        echo 'master commision ' . $commission_amount . ' <br>';
                        if ($commission_amount > 0) {
                            $commission = [
                                'agent_id' => $key->id,
                                'deposit_amount' => $deposit_balance,
                                'commission' => $master_commission,
                                'local_currency_id' => $local_currency->default_currency,
                                'local_amount_commission' => $commission_amount,
                                'currency_amount' => $c_amount->price_value,
                                'usd_amount_commission' => $usd_amount,
                                'staff_id' => $key->create_by,
                            ];
                            $this->db->insert('tblbet_agent_comission', $commission);
                        }

                        //deposit commission by super agent
                        $super_info = $this->db->get_where(db_prefix() . 'staff', ['staffid' => $master_agent->create_by, 'active' => 1])->row();
                        if ($super_info) {
                            $super_commission = $super_info->commission; // get_option('bet_super_agent_commission');
                            $commission_amount_super = (($super_commission * $deposit_balance) / 100);
                            $usd_amount_super = $commission_amount_super / $c_amount->price_value;
                            echo 'super commision ' . $commission_amount_super . ' <br>';
                            if ($commission_amount_super > 0) {
                                $commission = [
                                    'agent_id' => $key->id,
                                    'deposit_amount' => $deposit_balance,
                                    'commission' => $super_commission,
                                    'local_currency_id' => $local_currency->default_currency,
                                    'local_amount_commission' => $commission_amount_super,
                                    'currency_amount' => $c_amount->price_value,
                                    'usd_amount_commission' => $usd_amount_super,
                                    'staff_id' => $super_info->staffid,
                                ];
                                $this->db->insert('tblbet_agent_comission', $commission);
                            }
                            //deposit commission by vip agent
                            $vip_info = $this->db->get_where(db_prefix() . 'staff', ['staffid' => $super_info->staff_reference, 'active' => 1])->row();
                            if ($vip_info) {
                                $vip_commission = $vip_info->commission; // get_option('bet_master_agent_commission');
                                $commission_amount = (($vip_commission * $deposit_balance) / 100);
                                $local_currency = $this->db->get_where(db_prefix() . 'clients', ['userid' => $key->userid])->row();
                                $c_amount = $this->db->get_where(db_prefix() . 'currencies', ['id' => $local_currency->default_currency])->row();
                                $usd_amount = $commission_amount / $c_amount->price_value;
                                echo 'VIP commision ' . $commission_amount . ' ';
                                if ($commission_amount > 0) {
                                    $commission = [
                                        'agent_id' => $key->id,
                                        'deposit_amount' => $deposit_balance,
                                        'commission' => $master_commission,
                                        'local_currency_id' => $local_currency->default_currency,
                                        'local_amount_commission' => $commission_amount,
                                        'currency_amount' => $c_amount->price_value,
                                        'usd_amount_commission' => $usd_amount,
                                        'staff_id' => $vip_info->staffid,
                                    ];
                                    $this->db->insert('tblbet_agent_comission', $commission);
                                }
                            }
                        }
                    }
                }
                //withdrow commission by move cash / normal agent
                $this->db->select_sum('amount');
                $Withdrow_balance = $this->db->get_where('tblwithraw_history', ['contact_id' => $key->id, 'is_commission' => 0, 'status' => 1])->row()->amount;
                $wm = (($key->agent_withdrow * $Withdrow_balance) / 100);
                if ($wm > 0) {
                    $withdrow = [
                        'agent_id' => $key->id,
                        'balance' => $wm,
                        'remark' => '(Weekly) Withdraw Commission',
                        'create_at' => get_staff_user_id(),
                    ];
                    $this->db->insert('tblagent_history', $withdrow);
                    $this->db->where('contact_id', $key->id)->update(db_prefix() . 'withraw_history', ['is_commission' => 1]);
                }
                if ($dm > 0 || $wm > 0) {
                    $this->db->insert('tblcommission_history', [
                        'contract_id' => $key->id, 'staff_id' => get_staff_user_id(), 'deposit_commission' => $key->agent_deposit, 'deposit_amount' => $dm, 'withdrow_commission' => $key->agent_withdrow, 'withdrow_amount' => $wm
                    ]);
                }
            }
        }
    }
    public function sync($type)
    {
        switch ($type) {
            case BETTING_ODDS:
                echo json_encode($this->betting_model->odds_sync());
                break;
            case 'bet':
                echo json_encode($this->corn_model->bet_sync($this->input->post()));
                break;
            case 'delete':
                echo json_encode($this->corn_model->delete_manual($this->input->post()));
                break;
            default:
                echo json_encode(['return' => false, 'message' => _l('b_sync_default')]);
                break;
        }
    }

    public function bet()
    {
        $data['category'] = $this->betting_model->category();
        $data['group'] = $this->betting_model->odds_group();
        $data['title'] = _l("b_bet");
        $this->load->view('admin/bet', $data);
    }

    public function report()
    {
        $data['title'] = _l("b_report");
        $this->load->view('admin/report', $data);
    }

    public function user()
    {
        $data['title'] = _l("b_user");
        $this->load->view('admin/user', $data);
    }
    public function deposit()
    {
        $data['title'] = _l("b_deposit");
        $data['deposit'] = $this->db->get('tbluser')->result();
        $this->load->view('admin/deposit', $data);
    }

    public function usdt_deposit()
    {
        $data['title'] = _l("b_usdt_deposit");
        $data['deposit'] = $this->db->get('tbluser')->result();
        $this->load->view('admin/usdt_deposit', $data);
    }


    public function settings()
    {

        if ($this->input->post()) {

            $image = ['bkash', 'nagad', 'rocket', 'bank', 'stripe', 'coinbase', 'perfect_money', 'usdt'];

            foreach ($image as $key) {
                $filename = $_FILES[$key]['name'];
                if ($filename != '') {
                    $path = 'modules/betting/upload/agent/';
                    $upload_file = '';

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    $config = [
                        'upload_path' => $path,
                        'allowed_types' => 'gif|jpg|png|webp|jpeg',
                        'encrypt_name' => true,
                    ];
                    $this->load->library('upload', $config);
                    $row = $this->db->get_where('tbloptions', ['name' => $key])->row();


                    if ($this->upload->do_upload($key)) {

                        $upload_file = $this->upload->data('file_name');
                        // echo json_encode($upload_file);
                        if (isset($row->value) && $row->value != '') {
                            if (file_exists($path . $row->value)) {
                                unlink($path . $row->value);
                            }
                        }

                        $this->db->where('name', $key);
                        $this->db->update('tbloptions', ['value' => $upload_file]);
                    }
                }
                // sleep(1);
            }
            // die;
            $settiings = $this->input->post('settings');

            foreach ($settiings as $key => $setting) {
                $this->db->where('name', $key);
                $this->db->update('tbloptions', ['value' => $setting]);
            }
            set_alert('success', _l('b_settings_save'));
            redirect(admin_url('betting/admin/settings'));
        }

        $data['title'] = _l("b_setting");
        $this->load->view('admin/settings', $data);
    }






    // ++++++++++++++++++++++  =============================
    public function category_add()
    {
        $result = $this->betting_model->category_add();

        if ($result) {
            set_alert('success',  _l('b_success_save'));
        } else {
            set_alert('danger',  _l('b_already_have'));
        }
        echo json_encode('redirect');
    }



    public function category_delete($id)
    {
        $table = db_prefix() . 'sports_category';
        $path = 'upload/category/';
        $result = $this->betting_model->common_delete($id, $table);

        if ($result) {
            set_alert('success', _l('b_success_delete'));
            redirect(admin_url('betting/admin/category'));
        }
    }

    public function casino_provider_delete($id)
    {
        $table = db_prefix() . 'bet_provider';

        $result = $this->betting_model->common_delete($id, $table);
        if ($result) {
            set_alert('success', _l('b_success_delete'));
            redirect(admin_url('betting/admin/casino_info'));
        }
    }

    public function category_status($id, $status)
    {
        $result = $this->betting_model->category_status($id, $status);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }

    public function agent_check()
    {
        $email = $this->input->post('agent_email');
        $staff_info = $this->db->get_where('tblcontacts', ['email' => $email, 'active' => 1])->row();
        if ($staff_info) {
            echo json_encode(['return' => true, 'url' => $staff_info]);
        } else {
            echo json_encode(['return' => false, 'url' => '']);
        }
    }

    public function add_user($id = 0)
    {
        if ($id != 0) {
            $data['user'] = $this->db->get_where(db_prefix() . 'user', ['id' => $id])->row();
        }
        $data['title'] = _l("b_add_user");
        $this->load->view('admin/add-user', $data);
    }
    public function user_sattle($id)
    {

        $data['user_id'] = $id;
        $data['settle_amount'] = get_settle_balance($id);
        $data['title'] = _l("user history");
        $this->load->view('admin/user_history', $data);
    }


    public function insert_user()
    {
        $result = $this->betting_model->insert_user();
        echo json_encode($result);
    }

    public function user_delete($id)
    {
        $result = $this->betting_model->user_delete($id);
    }
    public function delete_bet()
    {
        $result = $this->db->where('id', $this->input->post('bet_id'))->delete(db_prefix() . 'betting');
        echo json_encode($result);
    }

    public function user_status($id, $status)
    {
        $table = db_prefix() . 'user';
        $field = 'is_active';
        $result = $this->betting_model->common_status($id, $table, $field, $status);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }


    // Slider Add/Update =================== 
    public function slider_add()
    {
        $result = $this->betting_model->slider_add();
        echo json_encode($result);
    }

    public function slider_status($id, $status)
    {
        $table = db_prefix() . 'slider';
        $field = 'status';
        $result = $this->db->where('slider_id', $id)->update($table, [$field => ($status == 0) ? 1 : 0]);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }
    public function master_active($id, $status)
    {
        $table = db_prefix() . 'staff';
        $field = 'active';
        $result = $this->db->where('staffid', $id)->update($table, [$field => ($status == 0) ? 1 : 0]);
        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }

    public function delete_slider($id, $image)
    {
        $result = $this->betting_model->delete_slider($id, $image);
        echo json_encode($result);
    }


    public function website_status($value, $field)
    {
        $table = db_prefix() . 'website';
        $result = $this->db->update($table, [$field => $value]);

        if ($result) {
            echo json_encode(_l('b_update_success'));
        }
    }


    public function header_update()
    {
        $result = $this->betting_model->header_update();
        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }


    public function update_home_content()
    {
        $table = db_prefix() . 'website';
        $data = $this->input->post();
        // print_r($data);
        // die;
        $result = $this->db->update($table, $data);
        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }

    public function footer_update()
    {
        $table = db_prefix() . 'website';
        $data = $this->input->post();
        $result = $this->db->update($table, $data);
        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }


    public function website_image_update()
    {
        $result = $this->betting_model->website_image_update();
        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }

    public function casino_update()
    {
        $result = $this->betting_model->casino_update();

        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }

    public function get_game_list($id)
    {
        $game = $this->db->get_where('tblbet_game_list', ['id' => $id])->row();
        echo json_encode($game);
    }

    public function casino_info()
    {
        $data['title'] = 'Casino info';
        $data['casino_category'] = 'common/modal/casino-category-modal';
        $data['casino_item'] = 'common/modal/casino-item-modal';
        $data['provider'] = 'common/modal/provider_edit';
        $data['edit_game'] = 'common/modal/game-edit';
        $this->load->view('admin/casino_info', $data);
    }


    public function casino_category()
    {
        $result = $this->betting_model->casino_category();
        if ($result) {
            set_alert('success', _l('Data Save Successfully.'));
            redirect(admin_url('betting/admin/casino_info'));
        }
    }
    public function provider_edit()
    {

        $result = $this->betting_model->provider_edit();
        if ($result) {
            set_alert('success', _l('Data Save Successfully.'));
            redirect(admin_url('betting/admin/casino_info'));
        }
    }
    public function casino_category_delete($id)
    {
        //$table = db_prefix() . 'bet_game_type';
        //echo json_encode($table);
        $table = db_prefix() . 'bet_game_type';
        $result = $this->betting_model->casino_category_delete($id, $table);

        if ($result) {
            set_alert('success', _l('b_success_delete'));
            redirect(admin_url('betting/admin/casino_info'));
        }
    }
    public function casino_item_add()
    {
        $result = $this->betting_model->casino_item_add();


        if ($result) {
            set_alert('success',  _l('b_success_save'));
            echo json_encode($result);
        } else {
            set_alert('danger',  _l('b_already_have'));
            echo json_encode($result);
        }
    }

    public function game_update()
    {
        $id = $this->input->post('id');
        $hot_game = $this->input->post('hot_game');
        $game_url = $this->input->post('game_url');
        $hot = 0;
        if ($hot_game) {
            $hot = 1;
        }
        $result = $this->db->where('id', $id)->update(db_prefix() . 'bet_game_list', ['image_url' => $game_url, 'is_hot' => $hot]);

        if ($result) {
            echo json_encode(['return' => true, 'message' =>  _l('b_update_success')]);
        } else {
            echo json_encode(['return' => false, 'message' =>  _l('somthing wrong')]);
        }
    }
    public function casino_item_delete($id)
    {
        $table = db_prefix() . 'casino_item';
        $result = $this->betting_model->common_delete($id, $table);

        if ($result) {
            set_alert('success', _l('b_success_delete'));
            redirect(admin_url('betting/admin/casino_info'));
        }
    }
    public function menual()
    {
        echo json_encode($this->corn_model->add_menual($this->input->post()));
    }


    public function current_currency_rate()
    {
        $currency_id = $this->input->post('curr');
        $currencies = $this->db->get_where(db_prefix() . 'currencies')->result();

        echo json_encode($currencies);
    }


    public function currency_rate_update()
    {
        $id = $this->input->post('currency_id');
        $price = $this->input->post('price_value');
        $p = $this->input->post('price');
        foreach ($p as $key => $value) {
            $this->db->where('id', $key)->update(db_prefix() . 'currencies', ['price_value' => $value]);
        }
        echo ($price);
        // $result = $this->db->where('id', $id)->update(db_prefix() . 'currencies', ['price_value' => $price]);
        // if ($result) {

        // }
    }

    public function delete($type)
    {
        echo json_encode($this->corn_model->delete($type, $this->input->post()));
    }


    public function edit($type)
    {
        echo json_encode($this->corn_model->edit($type, $this->input->post()));
    }



    public function deposit_accept()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '1',
        ];
        $result = $this->db->where('deposit_id', $data['deposit_id'])->update(db_prefix() . 'deposit_history', $update_data);

        if ($result) {
            set_alert('success',  _l('b_update_success'));
        } else {
            set_alert('danger',  _l('b_something_wrong'));
        }
        echo json_encode('redirect');
    }
    public function deposit_reject()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '2',
        ];
        $result = $this->db->where('deposit_id', $data['deposit_id'])->update(db_prefix() . 'deposit_history', $update_data);

        if ($result) {
            set_alert('success',  _l('b_update_success'));
        } else {
            set_alert('danger',  _l('b_something_wrong'));
        }
        echo json_encode('redirect');
    }
    public function withdraw()
    {
        $data['title'] = _l('b_withdraw');
        $data['user'] = $this->db->get('tbluser')->result();
        $this->load->view('admin/withdraw', $data);
    }
    public function commission()
    {
        $data['title'] = _l('b_agent') . ' ' . _l('b_commission');
        $this->load->view('admin/commission', $data);
    }
    public function withdraw_accept()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '1',
        ];
        $result = $this->db->where('id', $data['id'])->update(db_prefix() . 'withraw_history', $update_data);

        if ($result) {
            echo json_encode(['return' => true, 'message' =>  _l('b_update_success')]);
        } else {
            echo json_encode(['return' => false, 'message' =>  _l('b_something_wrong')]);
        }
    }
    public function withdraw_reject()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '2',
        ];
        $result = $this->db->where('id', $data['id'])->update(db_prefix() . 'withraw_history', $update_data);

        if ($result) {
            echo json_encode(['return' => true, 'message' =>  _l('b_update_success')]);
        } else {
            echo json_encode(['return' => false, 'message' =>  _l('b_something_wrong')]);
        }
    }

    public function sync_casino_info()
    {

        $header = [];
        $base_url = BETTING_API;

        $GamesCurrency = $base_url . 'GamesCurrency'; // . header_to_string($header);
        $GamesType = $base_url . 'GamesType'; // . header_to_string($header);
        $GamesLanguage = $base_url . 'GamesLanguage'; // . header_to_string($header);
        $GamesProvider = $base_url . 'GamesProvider'; // . header_to_string($header);
        $GamesList = $base_url . 'GamesList'; // . header_to_string($header);
        $GamesLaunch = $base_url . 'GamesLaunch'; // . header_to_string($header);
        //$RRR = sign();
        $currency = json_decode(sync_bet_all_data($GamesCurrency));
        $curr = $currency->data;
        $Type = json_decode(sync_bet_all_data($GamesType));
        $G_Type = $Type->data;

        $langu = json_decode(sync_bet_all_data($GamesLanguage));
        $lang = $langu->data;

        $provider = json_decode(sync_bet_all_data($GamesProvider));
        $g_provide = $provider->data;

        // game tupe insert
        $sync_success = 0;
        $sync_fail = 0;
        if (isset($G_Type) && $G_Type != []) {
            $this->db->empty_table('tblbet_game_type');
            foreach ($G_Type as $key => $value) {

                $insert_item = [
                    'type_id' => $key,
                    'type_name' => $value,
                    'is_api' => 1,
                ];
                $this->db->insert('tblbet_game_type', $insert_item);
            }
            $sync_success = $sync_success + 1;
        } else {
            $sync_fail = $sync_fail + 1;
        }
        // language insert
        if (isset($lang) && $lang != []) {
            $this->db->empty_table('tblbet_language');
            foreach ($lang as $key => $value) {

                $insert_item = [
                    'lang_id' => $key,
                    'lang_name' => $value,
                ];
                $this->db->insert('tblbet_language', $insert_item);
            }
            $sync_success = $sync_success + 1;
        } else {
            $sync_fail = $sync_fail + 1;
        }
        if (isset($curr) && $curr != []) {
            $this->db->empty_table('tblbet_currency');
            foreach ($curr as $key => $value) {

                $insert_item = [
                    'currency_id' => $key,
                    'currnecy_name' => $value,
                ];
                $this->db->insert('tblbet_currency', $insert_item);
            }
            $sync_success = $sync_success + 1;
        } else {
            $sync_fail = $sync_fail + 1;
        }
        // provider insert
        if (isset($g_provide) && $g_provide != []) {

            $this->db->empty_table('tblbet_provider');
            foreach ($g_provide as $key => $value) {

                foreach ($value->Type as $k) {
                    $insert_item = [
                        'provider_id' => $value->Id,
                        'provider_name' => $value->Name,
                        'provider_type' => $k,
                    ];
                    $this->db->insert('tblbet_provider', $insert_item);
                }
            }

            $sync_success = $sync_success + 1;
        } else {
            $sync_fail = $sync_fail + 1;
        }
        echo json_encode(['return' => true, 'message' =>  'Successfully Sync:  ' . $sync_success . '  Fail Sync:  ' . $sync_fail]);
    }
    public function sync_game_list_info($id, $type)
    {

        $base_url = BETTING_API;
        $GamesList = $base_url . 'GamesList'; // . header_to_string($header);
        //$game_type = $this->db->get('tblbet_game_type')->result();

        $game = array();
        $c_all = array();
        $this->db->where(['provider_id' => $id, 'game_type' => $type])->delete('tblbet_game_list');
        //echo json_encode($game_type);


        $all_game = json_decode(sync_bet_all_game($GamesList, $type, $id), true);

        if ($all_game['status'] == "true") {
            array_push($game, $all_game['data']);
            foreach ($all_game['data'] as $keys) {
                array_push($c_all, $type);
                $insert_item = [
                    'game_type' => $type,
                    'provider_id' => $id,
                    'game_code' => $keys['GameCode'],
                    'game_name' => $keys['GameName'],
                    'category' => $keys['Category'],
                    'image_url' => $keys['ImageUrl'],
                    'provider_game_type' => $keys['ProviderGameType'],
                    'provider_code' => $keys['ProviderCode'],
                ];
                $this->db->insert('tblbet_game_list', $insert_item);
            }
        }

        if (isset($game) && $game != []) {
            echo json_encode(['return' => true, 'message' =>  count($c_all) . ' games Sync Successfully', 'output' => $all_game]);
        } else {
            echo json_encode(['return' => false, 'message' =>  'There is no data Found thank you', 'output' => $all_game]);
        }
    }
    public function set_currency()
    {
        //echo json_encode($this->input->post('group'));
        $country = $this->input->post('country');
        foreach ($this->input->post('group') as $key => $value) {
            $this->db->where('id', $key);
            $result = $this->db->update('tblcurrencies', [
                'set_id' => $value,
                'country_id' => $country[$key]
            ]);
        }

        if ($result) {
            set_alert('success', _l('b_update_success'));
        } else {
            set_alert('success', _l('b_something_wrong'));
        }
        redirect(admin_url('betting/admin/website'));
    }
}
