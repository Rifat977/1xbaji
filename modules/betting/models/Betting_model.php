<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Betting_model extends App_Model
{

    public function odds_sync()
    {
        $response = betting_curl('https://api.the-odds-api.com/v4/sports/?apiKey=' . get_option('betting_odds_api_key'));
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message']];
        } else {

            $this->db->empty_table(db_prefix() . 'odds_sports');
            foreach ($output as $value) {
                $this->db->insert(db_prefix() . 'odds_sports', [
                    'sports_key' => $value['key'],
                    'groups' => $value['group'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'is_active' => $value['active'],
                    'has_outrights' => $value['has_outrights'],
                    'staff_id' =>  get_staff_user_id(),
                    'bet' => betting_key_check($value['key'], BETTING_ODDS)
                ]);
            }
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }
    public function odds_group()
    {
        $this->db->group_by('groups');
        return $this->db->order_by('groups')->get(db_prefix() . 'odds_sports')->result_array();
    }
    public function category()
    {
        return $this->db->order_by('name')->get_where(db_prefix() . 'sports_category', ['id_active' => 1])->result_array();
    }
    public function  odds_sports($key)
    {
        $apikey = get_option('betting_odds_api_key');
        $regions = get_option('betting_odds_region');
        $oddsFormat = get_option('betting_odds_oddsFormat');
        $response = betting_curl("https://api.the-odds-api.com/v4/sports/$key/odds/?apiKey=$apikey&regions=$regions&markets=h2h,spreads&oddsFormat=$oddsFormat");
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message'], 'output' => []];
        } else {
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }
    public function add_sports($data)
    {
        $key = $data['key'];
        $type = $data['type'];
        $find = $this->db->get_where(db_prefix() . 'betting', ['rel_id' => $key, 'rel_type' => $type])->row();
        if (!empty($find)) {
            return false;
        } else {
            $this->db->insert(db_prefix() . 'betting', [
                'rel_id' => $key,
                'rel_type' => $type,
                'staff_id' => get_staff_user_id(),
                'category_id' => $data['category']
            ]);
            if ($type == BETTING_ODDS) {
                $this->db->where('sports_key', $key);
                $this->db->update(db_prefix() . 'odds_sports', [
                    'bet' => 1
                ]);
            }

            return true;
        }
    }
    public function odds_actived($key)
    {
        $find = $this->db->get_where(db_prefix() . 'betting', ['rel_id' => $key, 'rel_type' => BETTING_ODDS, 'is_active' => 1])->row();
        if (!empty($find)) {
            return $find;
        } else {
            return false;
        }
    }
    public function update_sports($id, $data)
    {
        $find = $this->db->get_where(db_prefix() . 'betting', ['id' => $id])->row();
        if (!empty($find)) {
            $this->db->where('id', $id);
            $this->db->update(db_prefix() . 'betting', [
                'category_id' => $data['category']
            ]);
            return true;
        } else {
            return false;
        }
    }
    public function odds_betting($id)
    {
        $find = $this->db->get_where(db_prefix() . 'betting', ['category_id' => $id])->result();
        $output = [];
        if (count($find) > 0) {
            foreach ($find as $bet) {
                $dt = $this->odds_sports($bet->rel_id);
                if ($dt['return']) {
                    $sports = $this->db->get_where(db_prefix() . 'odds_sports', ['sports_key' => $bet->rel_id])->row();
                    array_push($output, ["sports" => $sports, "bet" => $dt['output']]);
                }
            }
        }
        return $output;
    }
    public function event_odds($key, $id)
    {
        $apikey = get_option('betting_odds_api_key');
        $regions = get_option('betting_odds_region');
        $oddsFormat = get_option('betting_odds_oddsFormat');
        $url = "https://api.the-odds-api.com/v4/sports/cricket_asia_cup/events/140ee3cb492ccfff4e109080b13d05aa/odds?apiKey=$apikey&regions=$regions&markets=h2h,spreads&oddsFormat=$oddsFormat";
        $response = betting_curl($url);
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message'], 'output' => []];
        } else {
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }



    public function category_add()
    {
        $category = $this->input->post('category');
        $id = $this->input->post('id');
        $filename = $_FILES['image']['name'];

        $table = db_prefix() . 'sports_category';
        $path = 'modules/betting/upload/category/';
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

        $data = [
            'name' => $category,
            'staff_id' => get_staff_user_id(),
        ];

        if ($id != 0) {
            $row = $this->db->get_where($table, ['id' => $id])->row();
            if ($filename != '') {
                if ($this->upload->do_upload('image')) {
                    $upload_file = $this->upload->data('file_name');
                    // Image  Update Code
                    if (isset($row->image) && $row->image != '') {
                        if (file_exists($path . $row->image)) {
                            unlink($path . $row->image);
                        }
                    }
                    $data['image'] = $upload_file;
                }
            }
        } else {
            if ($filename != '') {
                if ($this->upload->do_upload('image')) {
                    $upload_file = $this->upload->data('file_name');
                    $data['image'] = $upload_file;
                }
            }
        }

        if ($id == 0) {
            $result = $this->db->insert($table, $data);
        } else {
            $result = $this->db->where('id', $id)->update($table, $data);
        }
        return $result;
    }


    public function common_delete($id, $table, $path = '')
    {
        $row = $this->db->get_where($table, ['id' => $id])->row();
        if (isset($row) && isset($row->image)) {
            if ($row->image != '') {
                if (file_exists($path . $row->image)) {
                    unlink($path . $row->image);
                }
            }
        }
        $result = $this->db->where('id', $id)->delete($table);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function category_status($id, $status)
    {
        $result = $this->db->where('id', $id)->update(db_prefix() . 'sports_category', ['id_active' => ($status == 0) ? 1 : 0]);

        return $result;
    }

    public function insert_user()
    {
        $this->load->library('form_validation');


        $table = db_prefix() . 'user';
        $data = $this->input->post();
        $id = $data['id'];
        $password = $data['password'];

        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        if ($id == 0) {
            $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|is_unique[tbluser.user_email]');
            $this->form_validation->set_rules('user_name', 'user_name', 'required|is_unique[tbluser.user_name]');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[tbluser.mobile]');
        } else {
            $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('user_name', 'user_name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        }
        

        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('currency_id', 'Currency', 'required');
        // $this->form_validation->set_rules('country_code', 'Country Code', 'required');
        // $this->form_validation->set_rules('address', 'Address', 'required');
        // $this->form_validation->set_rules('state', 'State', 'required');
        // $this->form_validation->set_rules('city', 'City', 'required');
        // $this->form_validation->set_rules('zip', 'Zip', 'required');

        if ($id == 0) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        } else {
            if ($data['password'] != '') {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            }
        }

        if (empty($data['reference'])) {
            $staff = $this->db->get_where(db_prefix() . 'staff', ['admin' => 1])->row();
            $reference = $staff->staffid;
        } else {
            $reference = $data['reference'];
        }

        if ($this->form_validation->run()) {
            if (strpos($data['user_email'], '@gmail.com') != false) {
                $insert_data = [
                    'full_name' => $data['full_name'],
                    'user_name' => $data['user_name'],
                    'user_email' => $data['user_email'],
                    'mobile' => $data['mobile'],
                    'country' => $data['country'],
                    'currency_id' => $data['currency_id'],
                    // 'country_code' => $data['country_code'],
                    // 'address' => $data['address'],
                    // 'state' => isset($data['state'])?$data['state']:'',
                    // 'city' => isset($data['city'])?$data['city']:'',
                    // 'zip' => isset($data['zip'])?$data['zip']:'',
                    'reference' => $reference,
                    'staff_id' => get_staff_user_id(),
                    'contact_id' => isset($data['contact_id']) ? $data['contact_id'] : 0,
                    'is_active' => 1,
                ];

                if ($id == 0) {
                    $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT);
                    $insert_data['password_text'] = $password;
                    $insert_data['hash'] = app_generate_hash();

                    $result = $this->db->insert($table, $insert_data);

                    $this->session->set_userdata('logged_in', $this->db->get_where($table, ['id' => $this->db->insert_id()])->row());
                    set_alert('success', _l('b_success_save'));
                    return (['success' => _l('b_success_save')]);
                } else {
                    if ($data['password'] != '') {
                        $insert_data['password'] = password_hash($password, PASSWORD_BCRYPT);
                        $insert_data['password_text'] = $password;
                    }
                    $result = $this->db->where('id', $id)->update($table, $insert_data);



                    set_alert('success', _l('b_update_success'));
                    return (['success' => _l('b_update_success')]);
                }
            } else {
                $arr = [
                    'error' => true,
                    'user_emailErr' => 'Email Must be @gmail.com',
                    'nameErr' => '',
                    'mobileErr' => '',
                    'countryErr' => '',
                    'currencyErr' => '',
                    'country_codeErr' => '',
                    'addressErr' => '',
                    'stateErr' => '',
                    'cityErr' => '',
                    'zipErr' => '',
                    'user_name_err' => '',
                    'passwordErr' => '',
                    'confirm_passwordErr' => '',
                ];

                return ($arr);
            }
        } else {
            $arr = [
                'error' => true,
                'nameErr' => form_error('full_name'),
                'user_emailErr' => form_error('user_email'),
                'mobileErr' => form_error('mobile'),
                'countryErr' => form_error('country'),
                'currencyErr' => form_error('currency_id'),
                'country_codeErr' => form_error('country_code'),
                'addressErr' => form_error('address'),
                'stateErr' => form_error('state'),
                'cityErr' => form_error('city'),
                'zipErr' => form_error('zip'),
                'user_name_err' => form_error('user_name'),
                'passwordErr' => form_error('password'),
                'confirm_passwordErr' => form_error('confirm_password'),
            ];

            return ($arr);
        }
    }


    public function login()
    {
        $user_email = $this->input->post('user_email');
        $password = $this->input->post('password');
        $user = $this->db->get_where(db_prefix() . 'user', ['user_name' => $user_email, 'is_active' => 1])->row();
        if ($user) {
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata('logged_in', $user);
                return $user;
            } else {
                // set_alert('danger', 'Email or Password are Incorrect!');
                return false;
            }
            return false;
        } else {
            return 'error';
        }
    }


    public function user_delete($id)
    {
        $result = $this->db->where('id', $id)->delete(db_prefix() . 'user');
        if ($result) {
            set_alert('success', _l('b_success_delete'));
            redirect(admin_url('betting/admin/user'));
        }
    }

    public function common_status($id, $table, $field, $status)
    {
        $result = $this->db->where('id', $id)->update($table, [$field => ($status == 0) ? 1 : 0]);

        return $result;
    }


    public function slider_add()
    {
        $id = $this->input->post('id');

        $slider_url = $this->input->post('slider_url');
        $file = $_FILES['image']['name'];
        $table = db_prefix() . 'slider';
        $path = 'modules/betting/upload/slider/';
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



        $data = [
            'staff_id' => get_staff_user_id(),
            'slider_url' => $slider_url,
        ];

        if ($file != '') {
            if ($this->upload->do_upload('image')) {
                $upload_file = $this->upload->data('file_name');
                $data['image'] = $upload_file;
            }
        }

        if ($id == 0) {
            if ($upload_file != '') {
                $result = $this->db->insert($table, $data);
            } else {
                return _l('b_select_image');
            }
        } else {
            $row = $this->db->get_where(db_prefix() . 'slider', ['slider_id' => $id])->row();
            if (!empty($row)) {
                if (isset($row->image) && !empty($row->image)) {
                    if (file_exists($path . $row->image)) {
                        unlink($path . $row->image);
                    }
                }
                $result = $this->db->where('slider_id', $id)->update($table, $data);
            } else {
                return false;
            }
        }
        if ($result) {
            if ($id == 0) {
                return _l('b_success_save');
            } else {
                return _l('b_update_success');
            }
        }
    }


    public function delete_slider($id, $image)
    {
        $path = 'modules/betting/upload/slider/';

        if ($image != '') {
            if (file_exists($path . $image)) {
                unlink($path . $image);
            }
        }

        $result = $this->db->where('slider_id', $id)->delete(db_prefix() . 'slider');
        if ($result) {
            return _l('b_success_delete');
        }
    }

    public function header_update()
    {
        $row = $this->db->get(db_prefix() . 'website')->row();
        $marquee = $this->input->post('marquee');
        $file = $_FILES['header_logo']['name'];
        $table = db_prefix() . 'website';
        $path = 'modules/betting/upload/website/';
        $upload_file = '';
        $data = [
            'marquee' => $marquee,
        ];

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $config = [
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|png|webp|jpeg',
            'encrypt_name' => true,
        ];
        $this->load->library('upload', $config);

        if (!empty($file)) {
            if ($this->upload->do_upload('header_logo')) {
                $upload_file = $this->upload->data('file_name');
                if (isset($row) && $row->header_logo != '') {
                    if (file_exists($path . $row->header_logo)) {
                        unlink($path . $row->header_logo);
                    }
                }
                $data['header_logo'] = $upload_file;
            }
        }

        $rs = $this->db->update($table, $data);
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    public function website_image_update()
    {
        $login_bg_img = $_FILES['login_bg_img']['name'];
        $website_bg_img = $_FILES['website_bg_img']['name'];
        $sign_up_banner = $_FILES['sign_up_banner']['name'];
        $table = db_prefix() . 'website';
        $path = 'modules/betting/upload/website/';
        $row = $this->db->get($table)->row();

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $config = [
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|jpeg|png|webp',
            // 'encrypt_name' => true,
        ];
        $this->load->library('upload', $config);

        $images = [
            'login_bg_img' => $login_bg_img,
            'website_bg_img' => $website_bg_img,
            'sign_up_banner' => $sign_up_banner,
        ];

        // if (!empty($login_bg)) {
        //     if ($this->upload->do_upload('login_bg_img')) {
        //         $login_bg_name = $this->upload->data('file_name');
        //         if (isset($row) && !empty($row->login_bg_img)) {
        //             if (file_exists($path . $row->login_bg_img)) {
        //                 unlink($path . $row->login_bg_img);
        //             }
        //         }
        //         $data['login_bg_img'] = $login_bg_name;
        //     }
        // }

        // if (!empty($website_bg)) {
        //     if ($this->upload->do_upload('website_bg_img')) {
        //         $websit_bg_name = $this->upload->data('file_name');
        //         if (isset($row) && !empty($row->website_bg_img)) {
        //             if (file_exists($path . $row->website_bg_img)) {
        //                 unlink($path . $row->website_bg_img);
        //             }
        //         }
        //         $data['website_bg_img'] = $websit_bg_name;
        //     }
        // }

        foreach ($images as $k => $v) {
            if (!empty($v)) {
                if ($this->upload->do_upload($k)) {

                    $name = $this->upload->data('file_name');
                    if (isset($row) && !empty($row->$k)) {
                        if (file_exists($path . $row->$k)) {
                            unlink($path . $row->$k);
                        }
                    }
                    $data[$k] = $name;
                }
            }
        }

        if (isset($data)) {
            $this->db->update($table, $data);
            return true;
        } else {
            return false;
        }
    }

    public function casino_update()
    {
        $data = $this->input->post();

        $casino_logo_1 = $_FILES['casino_logo_1']['name'];
        $casino_logo_2 = $_FILES['casino_logo_2']['name'];
        $casino_logo_3 = $_FILES['casino_logo_3']['name'];
        $casino_logo_4 = $_FILES['casino_logo_4']['name'];
        $casino_logo_5 = $_FILES['casino_logo_5']['name'];
        $casino_logo_6 = $_FILES['casino_logo_6']['name'];
        $table = db_prefix() . 'website';
        $path = 'modules/betting/upload/website/casino/';
        $row = $this->db->get($table)->row();
        $images = [
            'casino_logo_1' => $casino_logo_1,
            'casino_logo_2' => $casino_logo_2,
            'casino_logo_3' => $casino_logo_3,
            'casino_logo_4' => $casino_logo_4,
            'casino_logo_5' => $casino_logo_5,
            'casino_logo_6' => $casino_logo_6,
        ];

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $config = [
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|jpeg|png|webp|svg',
            'encrypt_name' => true,
        ];
        $this->load->library('upload', $config);

        foreach ($images as $k => $v) {
            if (!empty($v)) {
                if ($this->upload->do_upload($k)) {

                    $name = $this->upload->data('file_name');
                    if (isset($row) && !empty($row->$k)) {
                        if (file_exists($path . $row->$k)) {
                            unlink($path . $row->$k);
                        }
                    }
                    $data[$k] = $name;
                }
            }
        }
        if (isset($data)) {
            $this->db->update($table, $data);
            return $data;
        } else {
            return false;
        }
    }

    public function get_casino_category()
    {
        $result = $this->db->get_where(db_prefix() . 'casino_category')->result();
        return $result;
    }

    public function casino_category()
    {

        $table = db_prefix() . 'bet_game_type';
        $id = $this->input->post("category_id");
        $data = [
            'type_name' => $this->input->post('category_name'),
            'order_by' => $this->input->post('order_by'),
        ];

        $filename = $_FILES['type_image']['name'];

        $path = 'modules/betting/upload/game-type/';
        $upload_file = '';
        $config = [
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|png|webp|jpeg|svg',
            'encrypt_name' => true,
        ];
        $this->load->library('upload', $config);

        if ($id != 0) {
            $row = $this->db->get_where($table, ['id' => $id])->row();

            if ($filename != '') {
                if ($this->upload->do_upload('type_image')) {
                    $upload_file = $this->upload->data('file_name');

                    if (isset($row->image) && $row->image != '') {
                        if (file_exists($path . $row->image)) {
                            unlink($path . $row->image);
                        }
                    }
                    $data['type_image'] = $upload_file;
                }
            }
        } else {
            if ($filename != '') {
                if ($this->upload->do_upload('image')) {
                    $upload_file = $this->upload->data('file_name');
                    $data['type_image'] = $upload_file;
                }
            }
        }


        if ($id == 0) {
            if (isset($data)) {
                $result = $this->db->insert($table, $data);
                return $data;
            } else {
                return false;
            }
        } else {
            if (isset($data)) {
                $this->db->where('id', $id)->update($table, $data);
                return $data;
            } else {
                return false;
            }
        }
    }
    public function provider_edit()
    {

        $table = db_prefix() . 'bet_provider';
        $id = $this->input->post("provider_id");
        $data = [
            'provider_name' => $this->input->post('provider_name'),
        ];

        $filename = $_FILES['provider_image']['name'];

        $path = 'modules/betting/upload/game-type/';
        $upload_file = '';
        $config = [
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|png|webp|jpeg|svg',
            'encrypt_name' => true,
        ];
        $this->load->library('upload', $config);

        if ($id != 0) {
            $row = $this->db->get_where($table, ['id' => $id])->row();

            if ($filename != '') {


                if ($this->upload->do_upload('provider_image')) {
                    $upload_file = $this->upload->data('file_name');

                    if (isset($row->image) && $row->image != '') {
                        if (file_exists($path . $row->image)) {
                            unlink($path . $row->image);
                        }
                    }
                    $data['provider_image'] = $upload_file;
                }
            }
        } else {
            if ($filename != '') {
                if ($this->upload->do_upload('image')) {
                    $upload_file = $this->upload->data('provider_image');
                    $data['provider_image'] = $upload_file;
                }
            }
        }
        // echo json_encode($data);
        // die;


        if ($id == 0) {
            if (isset($data)) {
                $result = $this->db->insert($table, $data);
                return $data;
            } else {
                return false;
            }
        } else {
            if (isset($data)) {
                $this->db->where('id', $id)->update($table, $data);
                return $data;
            } else {
                return false;
            }
        }
    }
    public function casino_category_delete($id, $table)
    {
        $result = $this->db->where('id', $id)->delete($table);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function casino_item_add()
    {

        $table = db_prefix() . 'casino_item';
        $path = 'modules/betting/upload/casino-item/';
        $upload_file = '';

        $this->load->library('form_validation');
        // $input_field = $this->input->post('');
        $this->form_validation->set_rules('casino_item_url', 'Item URL', 'required');
        $id = $this->input->post('id');

        $category_id = $this->input->post('category_id');
        $casino_sub_category = $this->input->post('casino_sub_category');
        $category_casinos = $this->input->post('category_casinos');
        $casino_item_url = $this->input->post('casino_item_url');
        $filename = $_FILES['image']['name'];

        if ($this->form_validation->run()) {

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $config = [
                'upload_path' => $path,
                'allowed_types' => 'gif|jpg|png|webp|jpeg|svg',
                'encrypt_name' => true,
            ];

            $this->load->library('upload', $config);

            $data = [
                // 'category_id' => $input_field['category_id'],
                // 'casino_item_url' => $input_field['casino_item_url'],
                // 'sub_category_item' => $input_field['category_casinos'],
                // 'sub2' => $input_field['casino_sub_category'],
                'category_id' => $category_id,
                'casino_item_url' => $casino_item_url,
                'sub_category_item' => $category_casinos,
                'sub2' => $casino_sub_category,
            ];

            if ($id != 0) {
                $row = $this->db->get_where($table, ['id' => $id])->row();
                if ($filename != '') {
                    if ($this->upload->do_upload('image')) {
                        $upload_file = $this->upload->data('file_name');
                        // Image  Update Code
                        if (isset($row->image) && $row->image != '') {
                            if (file_exists($path . $row->image)) {
                                unlink($path . $row->image);
                            }
                        }
                        $data['image'] = $upload_file;
                    }
                }
            } else {
                if ($filename != '') {
                    if ($this->upload->do_upload('image')) {
                        $upload_file = $this->upload->data('file_name');
                        $data['image'] = $upload_file;
                    }
                }
            }

            if ($id == 0) {
                $result = $this->db->insert($table, $data);
            } else {
                $result = $this->db->where('id', $id)->update($table, $data);
            }
            return $result;
        } else {
            $arr = [
                'error' => true,
                'casino_item_urlErr' => form_error('casino_item_url'),
            ];
            return $arr;
        }
    }

    public function get_sports()
    {
        $this->db->select('tblsports_category.name AS category_name, tblsports_category.id AS c_id, tblbetting.*');
        // $this->db->group_by('tblbetting.category_id');
        $this->db->join('tblsports_category', 'tblsports_category.id = tblbetting.category_id');
        $result = $this->db->get_where('tblbetting', ['is_active' => 1])->result();

        return ($result);
    }


    public function get_casino()
    {
        $this->db->select('tblcasino_category.*, tblcasino_item.*');
        $this->db->join('tblcasino_category', 'tblcasino_item.category_id = tblcasino_category.c_id');
        $result = $this->db->get('tblcasino_item')->result();
        return $result;
    }

    public function match_data()
    {
        $input = $this->input->post();

        $get_row = $this->db->get_where(db_prefix() . 'betting', ['id' => $input['main_id']])->row();

        return $get_row;
    }

    public function stack_setting()
    {
        $input = $this->input->post();

        $data = [
            'stack1' => $input['stack1'],
            'stack2' => $input['stack2'],
            'stack3' => $input['stack3'],
            'stack4' => $input['stack4'],
        ];

        $res = $this->db->where('id', $input['user_id'])->update(db_prefix() . 'user', $data);
        return $res;
    }



    public function bet_price()
    {
        $input = $this->input->post();

        $user_id = $_SESSION['logged_in']->id;
        $bet = $this->db->get_where(db_prefix() . 'betting', ['rel_id' => $input['sport_key']])->row();


        if (!empty($bet)) {
            if ($input['bet_type'] == 'auto') {
                if (!empty($bet->history)) {
                    $history =  ($bet->history);
                    if (isset(json_decode($history)->output->data)) {
                        $data = json_decode($history)->output->data;

                        foreach ($data as $key => $value) {
                            if (isset($value->bookmakers)) {
                                foreach ($value->bookmakers as $k => $v) {
                                    if ($v->key == $input['bet_key']) {
                                        foreach ($v->markets as $ke => $val) {
                                            foreach ($val->outcomes as $key => $value) {
                                                if ($value->name == $input['bet_name']) {
                                                    return $value->price;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else if ($input['bet_type'] == 'manual') {
                if (!empty($bet->manual)) {
                    $manual =  $bet->manual;

                    foreach (json_decode($manual) as $key => $value) {
                        if ($value->id == $input['sport_id']) {
                            if (!empty($value->bookmakers)) {
                                foreach ($value->bookmakers as $k => $v) {
                                    foreach ($v->markets as $key => $value) {
                                        if ($value->name == $input['bet_name']) {
                                            return $value->price;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // return $manual;
                }
            }
        }

        // $balance = user_balance($user_id);



        // print_r($balance);
    }
}
