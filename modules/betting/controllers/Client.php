<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Client extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('corn_model');
        if (!is_client_logged_in()) {
            redirect(site_url('authentication/login'));
        }
    }
    public function index()
    {
        // $row = $this->corn_model->corn();
        // echo json_encode($row);
    }
    public function userlist()
    {
        $data['title']            = _l('User List');
        $this->data($data);
        $this->view('agent/userlist');
        $this->layout();
    }
    public function deposit()
    {
        $data['title']            = _l('b_deposit');
        $this->data($data);
        $this->view('agent/deposit');
        $this->layout();
    }
    public function withraw()
    {
        $data['title']            = _l('b_withdraw');
        $this->data($data);
        $this->view('agent/withraw');
        $this->layout();
    }
    public function agent()
    {
        $data['title']            = _l('b_agent');

        $this->data($data);
        $this->view('agent/agent');
        $this->layout();
    }
    public function agent_add()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            //$data['contact_id'] = get_contact_user_id();

            if ($data['hidden_id'] == '') {
                $insert_data = [
                    'details' => $data['details'],
                    'type' => $data['type'],
                    'contact_id' => get_contact_user_id()
                ];
                $result = $this->db->insert('tblagent_details', $insert_data);
                if ($result) {
                    set_alert('success',  _l('b_success_save'));
                } else {
                    set_alert('danger',  _l('b_something_wrong'));
                }
                echo json_encode('redirect');
            } else {
                $update_data = [
                    'details' => $data['details'],
                    'type' => $data['type'],
                    'contact_id' => get_contact_user_id()
                ];
                $result = $this->db->where('id', $data['hidden_id'])->update(db_prefix() . 'agent_details', $update_data);

                if ($result) {
                    set_alert('success',  _l('b_update_success'));
                } else {
                    set_alert('danger',  _l('b_something_wrong'));
                }
                echo json_encode('redirect');
            }
        }
    }
    public function add_user()
    {
        $data = $this->input->post();
        $table = db_prefix() . 'user';
        $dt = $this->db->get_where($table, ['user_email' => $data['user_email']])->row();
        if (empty($dt)) {
            $insert_data = [
                'full_name' => $data['full_name'],
                'user_email' => $data['user_email'],
                'mobile' => $data['mobile'],
                'country' => $data['country'],
                'currency_id' => $data['currency_id'],
                'country_code' => $data['country_code'],
                'address' => $data['address'],
                'state' => isset($data['state']) ? $data['state'] : '',
                'city' => isset($data['city']) ? $data['city'] : '',
                'zip' => isset($data['zip']) ? $data['zip'] : '',
                'reference' => $data['currency_id'],
                'staff_id' => 0,
                'contact_id' => isset($data['contact_id']) ? $data['contact_id'] : 0,
                'is_active' => 1,
            ];
            $password = $data['confirm_password'];
            $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT);
            $insert_data['password_text'] = $password;
            $insert_data['hash'] = app_generate_hash();


            $result = $this->db->insert($table, $insert_data);
            set_alert('success',  'add successfull');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            set_alert('danger',  'email already insert try another on.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function deposit_accept()
    {
        $data = $this->input->post();
        $find_depo = $this->db->get_where('tbldeposit_history', ['deposit_user_id' => $data['user_id'], 'status' => 1])->row();
        if ($find_depo == null) {
            $depo_info = $this->db->get_where('tbldeposit_history', ['deposit_id' => $data['deposit_id']])->row();
            $persent = 10;
            $total = (($depo_info->amount * 10) / 100);
            $insert_data = [
                'user_id' => $data['user_id'],
                'deposit_id' => $data['deposit_id'],
                'amount' => $depo_info->amount,
                'commission_persent' => $persent,
                'total_amount' => $total,
            ];

            $this->db->insert('tblbet_bonus', $insert_data);
        }
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

    public function withdrow_accept()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '1',
        ];
        $result = $this->db->where('id', $data['withdrow_id'])->update(db_prefix() . 'withraw_history', $update_data);

        if ($result) {
            set_alert('success',  _l('b_update_success'));
        } else {
            set_alert('danger',  _l('b_something_wrong'));
        }
        echo json_encode('redirect');
    }
    public function withdrow_reject()
    {
        $data = $this->input->post();
        $update_data = [
            'status' => '2',
        ];
        $result = $this->db->where('id', $data['withdrow_id'])->update(db_prefix() . 'withraw_history', $update_data);

        if ($result) {
            set_alert('success',  _l('b_update_success'));
        } else {
            set_alert('danger',  _l('b_something_wrong'));
        }
        echo json_encode('redirect');
    }

    public function agent_edit()
    {
        if ($this->input->post('agent_id')) {
            $id = $this->input->post('agent_id');
            $result = $this->db->get_where('tblagent_details', ['id' => $id])->row();
            echo json_encode($result);
        }
    }
    public function agent_delete()
    {
        $data = $this->input->post();
        $result = $this->db->where('id', $data['delete'])->delete(db_prefix() . 'agent_details');
        if ($result) {
            set_alert('success', _l('b_success_delete'));
            echo json_encode('redirect');
        }
    }
}
