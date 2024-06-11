<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wing extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('betting_model');
        $this->load->model('corn_model');
        $this->theme = 'nynobet';
        $this->load->library('stripe_gateway');
        $this->ci = &get_instance();
        $this->STRIP_KEY      = $this->ci->stripe_gateway->decryptSetting('api_secret_key');
    }

    public function games($uuid)
    {
        // $data['uuid'] = $uuid;
        // $this->load->view('website/' . $this->theme . '/pages/games', $data);die;
        if (!is_null($this->session->userdata('logged_in'))) {

            $user = $this->db->get_where('tbluser', ['id' => $_SESSION['logged_in']->id])->row();
            $session_id = session_id();
            $currency = $this->db->get_where("tblcurrencies", ["id" => $user->currency_id])->row();
            $header = [
                'game_uuid' => $uuid,
                'currency' => $currency->name,
                //'page'=>3,
                'player_id' => $user->id,
                'player_name' => str_replace(' ', '_', $user->full_name),
                'session_id' => $session_id,
                // 'return_url'=>'https://back2bet.live/betting/call_back',
                // 'email'=>'vendor@gmail.com',
                // 'language'=>'english',
            ];

            $games_url = get_option('betting_games_casino_url') . 'games/init?' . header_to_string($header);
            //$games_url =  get_option('betting_games_casino_url') .'games?'.header_to_string($header);

            $method = 'GET';
            //$H1 = _header($header);

            // $games = json_decode(api($H1,$method,$games_url));
            // echo json_encode($games);
            // die;

            $play_game =  json_decode(api($header, $method, $games_url, true, true));
            if (isset($play_game) && isset($play_game->url)) {
                //echo '<a href="'.$play_game->url.'">click here</a>';
                //header('Location: ' . $play_game->url);
                //$this->db->insert('tblplay',['uuid'=>$uuid,'session_id'=>$session_id,'user_id'=>$user->id]);
                redirect($play_game->url);
            } else {
                echo json_encode($play_game);
            }
        } else {
            redirect(base_url());
            //header('Location: ' . base_url());
        }
        // $data['uuid'] = $uuid;
        // $this->load->view('website/' . $this->theme . '/pages/games', $data);
    }

    public function self_validate()
    {
        $header = [
            //'success' => true,
            // 'log' => ['{"action":"bet","amount":"0.75","currency":"EUR","game_uuid":"aa2e5406c83e798f6d32514d9204cf3fea1e224c","player_id":"8","transaction_id":"c9a42d1daf59410cb8e28426e3ec2516","session_id":"693d88e237c4fa14a0e341897cb9e144006c3ecd","type":"bet"}',
            //           '{"action":"win","amount":"2.75","currency":"EUR","game_uuid":"aa2e5406c83e798f6d32514d9204cf3fea1e224c","player_id":"8","transaction_id":"d4b10d8ef861453781f39e23c8eb09b6","session_id":"693d88e237c4fa14a0e341897cb9e144006c3ecd","type":"win"}'

            //          ]
        ];
        $games_url = get_option('betting_games_casino_url') . 'self-validate';
        $method = 'POST';
        $H1 = _header([]);
        //echo json_encode($H1);die;
        $self_validate =  (api($header, $method, $games_url, true));
        echo $self_validate;
    }
    public function get_agent_id()
    {
        $email = $this->input->post('agent_email');
        $user_c = $this->input->post('currency');
        $staff_info = $this->db->get_where('tblcontacts', ['email' => $email, 'active' => 1])->row();
        if ($staff_info) {
            $agent_curr = $this->db->get_where('tblclients', ['userid' => $staff_info->userid, 'default_currency' => $user_c])->row();
            if ($agent_curr) {
                echo json_encode(['return' => true, 'url' => $staff_info, 'message' => '']);
            } else {
                echo json_encode(['return' => false, 'url' => '', 'message' => 'Agent Currency Not Found']);
            }
        } else {
            echo json_encode(['return' => false, 'url' => '', 'message' => 'Agent Not Found']);
        }
    }
    public function get_country()
    {
        $c_id = $this->input->post('c_id');
        $currency_info = $this->db->get_where('tblcurrencies', ['country_id' => $c_id])->row();
        if ($currency_info) {
            echo json_encode(['return' => true, 'currency' => $currency_info]);
        } else {
            echo json_encode(['return' => false, 'currency' => '']);
        }
    }

    public function corn()
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher\Pusher(
            'de14478e50f9b87c7d32',
            'dacb86dec9f7e7c591a4',
            '1657279',
            $options
        );
        $cats = $this->betting_model->category();
        $data['category'] = $cats;
        $arr = [];
        foreach ($cats as $cat) {
            $f = $this->betting_model->odds_betting($cat['id']);
            if (!empty($f)) {
                foreach ($f as $odds) {
                    foreach ($odds['bet'] as $bet) {
                        //echo json_encode($bet['id']);
                        //echo "<br><br>";
                        $event = $this->betting_model->event_odds($bet['sport_key'], $bet['id']);
                        $o['event'] = $event['output'];
                        $o['odds'] = $bet;
                        $o['message'] = !$event['return'] ? $event['message'] : '';
                        $pusher->trigger($bet['sport_key'], $bet['id'], $o);
                    }
                }
            }
        }
        $data['betting'] = $arr;
    }
    public function category($id)
    {
        echo json_encode($this->betting_model->odds_betting($id));
    }
    // public function index()
    // {
    //   $data['category'] = $this->betting_model->category();
    //   $data['title'] = _l("betting");
    //   $this->load->view('website/' . $this->theme . '/home', $data);
    // }

    public function insert_user()
    {
        $result = $this->betting_model->insert_user();

        echo json_encode($result);
    }

    public function login()
    {
        if (isset($_SESSION['logged_in'])) {
            redirect(base_url('betting'));
        } else {
            $this->load->view('website/' . $this->theme . '/pages/login');
        }
    }

    public function auth()
    {
        $row = $this->betting_model->login();
        echo json_encode($row);
        // if ($row) {
        // redirect(base_url('betting'));
        // } else {
        // set_alert('danger', 'Email or Password are Incorrect!');
        // redirect(base_url('betting/login'));
        // }
    }

    public function registration()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/register',
            'footer' => 'website/' . $this->theme . '/layout/header',
        ];
        // $this->load->view('website/' . $this->theme . '/layout/master', $data);
        $this->load->view('website/' . $this->theme . '/pages/register');
    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect(base_url('betting/login'));
    }
    public function desk_logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect(base_url());
    }

    public function index()
    {

        $theme = $this->theme;
        if ($theme === 'backtobet') {
            $data = [
                'css' => '',
                'js' => '',
                'title' => _l("betting"),
                'body' => 'website/desktop2/pages/home',
                'deposit' => 'wbsite/desktop2/offcanvas/deposit',
                'footer' => 'website/desktop2/layout/footer',
                'category' => $this->betting_model->category(),
                'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
                'betting' => $this->corn_model->betting(),
                'casino_category' => $this->betting_model->get_casino_category(),
            ];
            $this->load->view('website/desktop2/layout/master', $data);
        } else {

            $data = [
                'css' => '',
                'js' => '',
                'title' => _l("betting"),
                'body' => 'website/' . $this->theme . '/pages/home',
                'footer' => 'website/' . $this->theme . '/layout/footer',
                'category' => $this->betting_model->category(),
                'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
                'betting' => $this->corn_model->betting(),
                'casino_category' => $this->betting_model->get_casino_category(),
            ];

            $this->load->view('website/' . $this->theme . '/layout/master', $data);
        }
    }
    public function nynobet()
    {

        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/home',
            'footer' => 'website/' . $this->theme . '/layout/footer',
            'category' => $this->betting_model->category(),
            'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
            'betting' => $this->corn_model->betting(),
            'casino_category' => $this->betting_model->get_casino_category(),
        ];

        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }
    public function wing_bet()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/home',
            'footer' => 'website/' . $this->theme . '/layout/footer',
            'category' => $this->betting_model->category(),
            'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
            'betting' => $this->corn_model->betting(),
            'casino_category' => $this->betting_model->get_casino_category(),
        ];

        $this->load->view('website/desktop2/layout/master', $data);
    }

    public function account()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/account',
            'footer' => 'website/' . $this->theme . '/layout/footer',
            'category' => $this->betting_model->category(),
            'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
            'betting' => $this->corn_model->betting(),
            'casino_category' => $this->betting_model->get_casino_category(),
        ];

        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }
    public function promotions()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/promotions',
            'footer' => 'website/' . $this->theme . '/layout/footer',
            'category' => $this->betting_model->category(),
            'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
            'betting' => $this->corn_model->betting(),
            'casino_category' => $this->betting_model->get_casino_category(),
        ];

        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }
    public function deposit_widthraw()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/deposit-widthraw',
            'footer' => 'website/' . $this->theme . '/layout/footer',
            'category' => $this->betting_model->category(),
            'slider' => $this->db->get_where(db_prefix() . 'slider', ['status' => 1])->result(),
            'betting' => $this->corn_model->betting(),
            'casino_category' => $this->betting_model->get_casino_category(),
        ];

        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }

    public function all_sports()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/sports-all',
            'footer_bottom' => 'website/' . $this->theme . '/layout/footer_bottom',
            'category' => $this->betting_model->category(),
            'sports' => $this->betting_model->get_sports(),
            'casino' => $this->betting_model->get_casino(),
            'casino_table' => db_prefix() . 'casino_item',
            'casino_category' => $this->betting_model->get_casino_category(),
        ];
        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }

    public function league_match($id = 0)
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/sports/league_match',
            'category' => $this->betting_model->category(),
        ];
        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }

    public function match_detail()
    {

        $main_id = $_GET['main_id'];
        $match_detail_row = $get_row = $this->db->get_where(db_prefix() . 'betting', ['id' => $main_id])->row();
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/' . $this->theme . '/pages/sports/match_detail',
            'category' => $this->betting_model->category(),
            'match_detail_row' => ($match_detail_row),
        ];
        if (!empty($_SESSION['logged_in'])) {
            $data['user'] = $this->db->get_where(db_prefix() . 'user', ['id' => $_SESSION['logged_in']->id])->row();
        }
        $this->load->view('website/' . $this->theme . '/layout/master', $data);
    }

    public function match_data()
    {
        $res = $this->betting_model->match_data();
        echo json_encode($res);
    }


    public function stack_setting()
    {
        $result = $this->betting_model->stack_setting();
        echo $result;
    }


    public function place_bet()
    {
        $input = $this->input->post();
        $user_id = $this->db->get_where(db_prefix() . 'user', ['id' => $_SESSION['logged_in']->id])->row()->id ?? 0;
        $amount = dollar_exchange($user_id, $input['stake_input']);
        $sport_id = $input['sport_id'];
        $sport_key = $input['sport_key'];
        $bet_name = $input['bet_name'];
        $bet_price = $this->betting_model->bet_price();
        $total = 0;
        if ($input['stake_input'] <= 5000) {
            if (own_balance($user_id) >= $input['stake_input']) {
                $total = floatval(($input['stake_input'] *  $bet_price) - $input['stake_input']);
                $data = [
                    'user_id' => $user_id,
                    'sport_id' => $input['sport_id'],
                    'sport_key' => $input['sport_key'],
                    'bet_name' => $input['bet_name'],
                    'bet_key' => $input['bet_key'],
                    'type' => $input['bet_type'] == 'auto' ? 0 : 1,
                    'team' => $input['bet_team'],
                    'dollar_rate' => $amount['dollar_rate'],
                    'dollar_amount' => $amount['dollar_amount'],
                    'bet_price' => $bet_price,
                    'bet_value' => $input['stake_input'],
                    'total' => $total,
                ];
                $this->db->insert(db_prefix() . 'bet_history', $data);
                echo json_encode(['message' => 'Bet Placed Successufully']);
            } else {
                echo json_encode(['error' => true, 'message' => 'Insufficient Balance']);
            }
        } else {
            echo json_encode(['error' => true, 'message' => "Can't Bet Over 5000"]);
        }
    }

    public function bet($key, $id)
    {
        $data['key'] = $key;
        $data['id'] = $id;
        $data['title'] = _l("betting");
        $this->load->view('website/' . $this->theme . '/bet', $data);
    }

    public function update_user_password()
    {
        $this->load->library('form_validation');
        $input = $this->input->post();
        $user = $this->db->get_where('tbluser', ['id' => $this->session->userdata('logged_in')->id])->row();
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run()) {
            if (!empty($user)) {
                if (password_verify($input['old_password'], $user->password)) {
                    $this->db->where('id', $user->id)->update('tbluser', ['password' => password_hash($input['password'], PASSWORD_BCRYPT), 'password_text' => $input['password']]);
                    set_alert('success', 'Password Update Successfully!');
                    $this->session->unset_userdata('logged_in');
                    echo json_encode(base_url('betting'));
                } else {
                    echo json_encode(['error' => true, 'old_passwordErr' => 'Old Password Not Matched!']);
                }
            } else {
                set_alert('success', 'User Not Found!');
                echo json_encode(base_url('betting'));
            }
        } else {
            $arr = [
                'error' => true,
                'old_passwordErr' => form_error('old_password'),
                'passwordErr' => form_error('password'),
                'confirm_passwordErr' => form_error('confirm_password'),
            ];

            echo json_encode($arr);
        }
    }




    public function get_sub_category($cat_id)
    {
        $result = $this->db->get_where(db_prefix() . 'casino_sub_category', ['cat_id' => $cat_id])->result();
        echo json_encode($result);
    }





















    public function payment($type)
    {
        $user = $this->db->get_where('tbluser', ['id' => $this->session->userdata('logged_in')->id])->row();
        if ($this->input->post() && !empty($user)) {
            $request = $this->input->post();
            $productID = 'p-' . rand(100000, 99999);

            if ($type == 'stripe') {
                $response = array(
                    'status' => 0,
                    'error' => array(
                        'message' => 'Invalid Request!'
                    )
                );
                if (json_last_error() !== JSON_ERROR_NONE) {
                    http_response_code(400);
                    echo json_encode($response);
                    exit;
                }
                if (!empty($request['createCheckoutSession'])) {
                    $stripe = new \Stripe\StripeClient($this->STRIP_KEY);
                    // Convert product price to cent 
                    //$_SESSION['service_iteam_id'] = $request->id;

                    $productName = "Diposit";

                    $stripeAmount = round($request['amount'] * 100, 2);
                    // Create new Checkout Session for the order 
                    try {
                        $checkout_session = $stripe->checkout->sessions->create([
                            'line_items' => [[
                                'price_data' => [
                                    'product_data' => [
                                        'name' => $productName,
                                        'metadata' => [
                                            'pro_id' => $productID
                                        ]
                                    ],
                                    'unit_amount' => $stripeAmount,
                                    'currency' => "usd",
                                ],
                                'quantity' => 1
                            ]],
                            'mode' => 'payment',
                            'success_url' =>  site_url(BETTING_MODULE_NAME . '/strip_success') . '/{CHECKOUT_SESSION_ID}',
                            'cancel_url' =>  site_url(BETTING_MODULE_NAME . '/strip_cancle/'),
                        ]);
                    } catch (Exception $e) {
                        $api_error = $e->getMessage();
                    }

                    if (empty($api_error) && $checkout_session) {
                        $response = array(
                            'status' => 1,
                            'message' => 'Checkout Session created successfully!',
                            'sessionId' => $checkout_session->id
                        );
                    } else {
                        $response = array(
                            'status' => 0,
                            'error' => array(
                                'message' => 'Checkout Session creation failed! ' . $api_error
                            )
                        );
                    }
                }
                echo json_encode($response);
            } else if ($type == 'coinbase') {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.commerce.coinbase.com/charges/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $post = array(
                    "name" => get_option('invoice_company_name'),
                    "description" => get_option('invoice_company_address'),
                    "local_price" => array(
                        'amount' => $request['amount'],
                        'currency' => 'USD'
                    ),
                    "pricing_type" => "fixed_price",
                    "metadata" => array(
                        'customer_id' =>  $productID,
                        'name' => $user->full_name
                    )
                );

                $post = json_encode($post);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_POST, 1);

                $headers = array();
                $headers[] = "Content-Type: application/json";
                $headers[] = "X-Cc-Api-Key: " . get_option('betting_coinbase_api_key');
                $headers[] = "X-Cc-Version: 2018-03-22";
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close($ch);
                $response = json_decode($result);
                echo $response->data->hosted_url;
            }

            die;
        }
        $data['type'] = $type;
        $data['title'] = _l("betting");
        $this->load->view('website/' . $this->theme . '/payment', $data);
    }

    public function  strip_success($session_id)
    {
        $stripe = new \Stripe\StripeClient($this->STRIP_KEY);
        $api_error = '';
        // Fetch the Checkout Session to display the JSON result on the success page 
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
            if ($checkout_session) {
                try {
                    $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
                    if ($paymentIntent) {
                        $transactionID = $paymentIntent->id;
                        $paidAmount = $paymentIntent->amount;
                        $paidAmount = ($paidAmount / 100);
                        $paidCurrency = $paymentIntent->currency;
                        $payment_status = $paymentIntent->status;
                        if ($payment_status == 'succeeded') {
                            $deposit_table = db_prefix() . 'user_deposit';
                            $deposit_history_table = db_prefix() . 'deposit_history';

                            $user_id = $this->session->userdata('logged_in')->id;
                            $hash = app_generate_hash();

                            $user = $this->db->get_where(db_prefix() . 'user', ['id' => $user_id])->row();
                            if (!empty($user)) {
                                $currency_ = $this->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row();
                            }
                            $currency_rate = isset($currency_) ? $currency_->price_value : 0;
                            $total_amount = $currency_rate * $paidAmount;

                            $deposit_history = [
                                'deposit_user_id' => $user_id,
                                // 'payment_id' => $hash,
                                'currency' => isset($currency_) ? $currency_->id : 0,
                                'base_amount' => $paidAmount,
                                'currency_rate' => $currency_rate,
                                'amount' => $total_amount,
                                'transactionID' => $transactionID,
                                'gateway' => 'Stripe',
                                'status' => 1
                            ];

                            $this->db->insert($deposit_history_table, $deposit_history);
                            set_alert('success', 'Deposit SuccessFull');
                            redirect(base_url('betting'));
                        }

                        set_alert('success', "Payment Successfully Done.");
                        //redirect(base_url('project/view_lead_tesk/?service_id=' . $id));
                    } else {
                        $statusMsg = "Unable to fetch the transaction details! $api_error";
                        set_alert('danger', $statusMsg);
                        //redirect(base_url('project/view_lead_tesk/?service_id=' . $id));
                    }
                } catch (\Stripe\Exception\ApiErrorException $e) {
                    $api_error = $e->getMessage();
                    set_alert('danger', $api_error);
                    //redirect(base_url('project/view_lead_tesk/?service_id=' . $id));
                }
            } else {
                $statusMsg = "Invalid Transaction! $api_error";
                set_alert('danger', $statusMsg);
                //redirect(base_url('project/view_lead_tesk/?service_id=' . $id));
            }
        } catch (Exception $e) {
            $api_error = $e->getMessage();
            set_alert('danger', $api_error);
            //redirect(base_url('project/view_lead_tesk/?service_id=' . $id));
        }
    }

    public function  strip_cancle()
    {
        $this->load->view('website/valkey/payment_cancel');
    }
    public function agent_payment()
    {

        echo json_encode($this->corn_model->agent($this->input->post()));
    }
    public function  usdt_payment()
    {
        echo json_encode($this->corn_model->usdt($this->input->post()));
    }
    public function confirm_online()
    {
        echo json_encode($this->corn_model->confirm_online($this->input->post()));
    }
    public function  confirm_agent()
    {
        echo json_encode($this->corn_model->confirm_agent($this->input->post()));
    }

    public function refresh_balance($user_id)
    {
        $res = round(own_balance($user_id), 2);

        echo json_encode($res);
    }
    public function withdrow_affiliate()
    {
        $user_id = $_SESSION['logged_in']->id;
        $my_affiliate = user_affiliate_balance($user_id);
        $variable = $this->db->order_by('datetime', 'DESC')->get_where(db_prefix() . 'user', ['reference' => $user_id])->result();
        foreach ($variable as $key => $value) {
            $data = [
                'user_id' => $user_id,
                'affiliate_withdrow' => affiliate_history($value->id),
                'level' => $value->id
            ];
            $this->db->insert(db_prefix() . 'affiliate_history', $data);
        }

        echo json_encode(true);
    }



    // ==============================
    //            desktop 
    // ======================
    public function casino()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/casino',
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    public function slot()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/slot',
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    public function tables()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/table',
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    public function lottery()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/lottery',
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    // public function promotions()
    // {
    //     $data = [
    //         'css' => '',
    //         'js' => '',
    //         'title' => _l("betting"),
    //         'body' => 'website/desktop2/pages/promotions',
    //     ];
    //     $this->load->view('website/' . $this->theme . '/layout/master', $data);
    // }
    public function deposit()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/deposit',
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    public function sports()
    {
        $data = [
            'css' => '',
            'js' => '',
            'title' => _l("betting"),
            'body' => 'website/desktop2/pages/sports/sports',
            // 'footer_bottom' => 'website/' . $this->theme . '/layout/footer_bottom',
            'category' => $this->betting_model->category(),
            'sports' => $this->betting_model->get_sports(),
            'casino' => $this->betting_model->get_casino(),
            'casino_table' => db_prefix() . 'casino_item',
            'casino_category' => $this->betting_model->get_casino_category(),
        ];
        $this->load->view('website/desktop2/layout/master', $data);
    }
    public function get_provider_game($p_id, $t_id)
    {
        // $start = $this->input->post('start');
        // $limit = $this->input->post('limit');
        //  $this->db->limit(30);
        $all_games = $this->db->get_where('tblbet_game_list', ['provider_id' => $p_id, 'game_type' => $t_id])->result();
        echo json_encode($all_games);
    }
    public function launch_game()
    {

        if (!is_null($this->session->userdata('logged_in'))) {
            $base_url = BETTING_API;
            $GamesLaunch = $base_url . 'GamesLaunch';
            $type = $this->input->post('type_id');
            $provider = $this->input->post('provider_id');
            $game = $this->input->post('game_id');

            $game_url = json_decode(launch_play_game($GamesLaunch, $type, $provider, $game, $this->session->userdata('logged_in')->id, $this->session->userdata('logged_in')->full_name));
            echo json_encode(['return' => true, 'url' => $game_url]);
        } else {
            echo json_encode(['return' => false]);
        }
    }
    public function show_games()
    {
        if ($this->input->post('p_id') == '') {
            $show_game = $this->db->limit(30)->get_where('tblbet_game_list', ['provider_id' => $this->input->post('id')])->result();
            $all_games = $this->db->get_where('tblbet_game_list', ['provider_id' => $this->input->post('id')])->result();
            $game = ['show_game' => $show_game, 'all_game' => $all_games];
            echo json_encode($game);
        } else {
            $show_game = $this->db->limit(30, $this->input->post('p_id'))->get_where('tblbet_game_list', ['provider_id' => $this->input->post('id')])->result();
            $all_games = $this->db->get_where('tblbet_game_list', ['provider_id' => $this->input->post('id')])->result();
            $game = ['show_game' => $show_game, 'all_game' => $all_games];
            echo json_encode($game);
        }
    }
}
