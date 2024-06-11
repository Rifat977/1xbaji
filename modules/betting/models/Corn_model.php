<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Corn_model extends App_Model
{
    public function betting()
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['is_active' => 1, 'rel_type' => 'odds'])->result();
        return  $soprts;
    }
    public function corn()
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['is_active' => 1, 'rel_type' => 'odds'])->result();

        foreach ($soprts as $sport) {
            $key = $sport->rel_id;
            $this->update_json($key, $sport->id);
        }
        return $soprts;
    }
    public function update_json($key, $id)
    {
        $Odds = $this->odds_sports($key);
        $all_event = [];
        if ($Odds['return']) {
            foreach ($Odds['output'] as $o) {
                $event = $this->odds_event($o['sport_key'], $o['id']);
                if ($event['return']) {
                    array_push($all_event, $event);
                }
            }
        }
        $score = $this->odds_scores($key);
        $history = [];
        if ($Odds['return'] && !empty($Odds['output'])) {
            $history = $this->odds_historical($key,   $Odds['output'][0]['commence_time']);
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'betting', ['history' => json_encode($history), 'json' => json_encode(['odds' => $Odds, 'event' => $all_event, 'score' => $score, 'history' => $history])]);
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
    public function odds_event($key, $id)
    {
        $apikey = get_option('betting_odds_api_key');
        $regions = get_option('betting_odds_region');
        $oddsFormat = get_option('betting_odds_oddsFormat');
        $url = "https://api.the-odds-api.com/v4/sports/$key/events/$id/odds?apiKey=$apikey&regions=$regions&markets=h2h,spreads&oddsFormat=$oddsFormat";
        $response = betting_curl($url);
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message'], 'output' => []];
        } else {
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }

    public function odds_scores($key)
    {
        $apikey = get_option('betting_odds_api_key');
        // $regions = get_option('betting_odds_region');
        // $oddsFormat = get_option('betting_odds_oddsFormat');
        $response = betting_curl("https://api.the-odds-api.com/v4/sports/$key/scores/?daysFrom=1&apiKey=$apikey");
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message'], 'output' => []];
        } else {
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }
    public function odds_historical($key, $time)
    {
        $apikey = get_option('betting_odds_api_key');
        $regions = get_option('betting_odds_region');
        $oddsFormat = get_option('betting_odds_oddsFormat');
        $response = betting_curl("https://api.the-odds-api.com/v4/sports/$key/odds-history/?apiKey=$apikey&regions=$regions&markets=h2h&oddsFormat=$oddsFormat&date=$time");
        $output = json_decode($response, true);
        if (isset($output['message'])) {
            return ['return' => false, 'message' => $output['message'], 'output' => []];
        } else {
            return ['return' => true, 'message' => _l('b_sync_done'), 'output' => $output];
        }
    }
    public function bet_sync($data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['id']])->row();
        if (!empty($soprts)) {
            $key = $soprts->rel_id;
            $this->update_json($key, $soprts->id);
            return ['return' => true, 'message' => _l('b_sync_done')];
        } else {
            return ['return' => false, 'message' => 'server problem'];
        }
    }

    public function delete($type, $data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['sports_id']])->row();
        if (!empty($soprts)) {
            $manual = $soprts->manual;
            $main_id = $data['main_id'];
            $bookmark_id = $data['bookmark_id'];

            if ($manual != '' && $manual != '[]' && strlen($manual) > 0) {
                $manual =  json_decode($soprts->manual);
                if ($type == 'bookmark') {
                    unset($manual[$main_id]->bookmakers[$bookmark_id]);
                    $this->db->where('id', $data['sports_id']);
                    $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($manual)]);
                    return ['return' => true];
                } else if ($type == 'market') {
                    $market_id = $data['market_id'];
                    unset($manual[$main_id]->bookmakers[$bookmark_id]->markets[$market_id]);
                    $this->db->where('id', $data['sports_id']);
                    $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($manual)]);
                    return ['return' => true];
                } else {
                    return ['return' => false];
                }
            } else {
                return ['return' => false];
            }
        } else {
            return ['return' => false];
        }
    }

    public function edit($type, $data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['sports_id']])->row();
        if (!empty($soprts)) {
            $manual = $soprts->manual;
            $main_id = $data['main_id'];
            $bookmark_id = $data['bookmark_id'];

            if ($manual != '' && $manual != '[]' && strlen($manual) > 0) {
                $manual =  json_decode($soprts->manual);
                if ($type == 'bookmark') {
                    $manual[$main_id]->bookmakers[$bookmark_id]->title =  $data['name'];
                    $this->db->where('id', $data['sports_id']);
                    $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($manual)]);
                    return ['return' => true];
                } else if ($type == 'market') {
                    $market_id = $data['market_id'];
                    $manual[$main_id]->bookmakers[$bookmark_id]->markets[$market_id]->name = $data['name'];
                    $this->db->where('id', $data['sports_id']);
                    $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($manual)]);
                    return ['return' => true];
                } else if ($type == 'market_price') {
                    $market_id = $data['market_id'];
                    $manual[$main_id]->bookmakers[$bookmark_id]->markets[$market_id]->price = $data['name'];
                    $this->db->where('id', $data['sports_id']);
                    $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($manual)]);
                    return ['return' => true];
                } else {
                    return ['return' => false];
                }
            } else {
                return ['return' => false];
            }
        } else {
            return ['return' => false];
        }
    }
    public function usdt($data)
    {
        //$agent = $this->db->get_where(db_prefix() . 'agent_details', ['id' => $data['id']])->row();
        //$contact = $this->db->get_where(db_prefix() . 'contacts', ['id' => $agent->id])->row();
        $user = $this->session->userdata('logged_in');
        $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
        $currency_id =  $user_details->currency_id;
        $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
        $rate = $currency->price_value;

        $this->db->insert('tbldeposit_history', [
            'deposit_user_id' => $user->id,
            'transactionID' => $data['txid'],
            'amount' => floatval($data['amount'] * $rate),
            'currency_rate' => floatval($rate),
            'base_amount' =>  floatval($data['amount']),
            'gateway' => 'USDT',
            'contact_id' => 0, //$contact->id,
            'agent_id' => 0, //$data['id'],
            'remark' => $data['remark'],
            'currency' =>  $currency_id,
        ]);
        return ['return' => true, 'message' => _l('b_approval')];
    }
    public function agent($data)
    {
        $agent = $this->db->get_where(db_prefix() . 'agent_details', ['id' => $data['id']])->row();
        $contact = $this->db->get_where(db_prefix() . 'contacts', ['id' => $agent->contact_id])->row();
        $user = $this->session->userdata('logged_in');
        $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
        $currency_id =  $user_details->currency_id;
        $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
        $rate = $currency->price_value;

        $this->db->insert('tbldeposit_history', [
            'deposit_user_id' => $user->id,
            'transactionID' => 0,
            'amount' => floatval($data['amount']),
            'currency_rate' => floatval($rate),
            'base_amount' => floatval($data['amount'] / $rate),
            'gateway' => 'Agent',
            'contact_id' => $contact->id,
            'agent_id' => $data['id'],
            'remark' => $data['remark'],
            'currency' =>  $currency_id,
        ]);
        return ['return' => true, 'message' =>  _l('b_approval')];
    }
    public function add_menual($data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['id']])->row();
        if (!empty($soprts)) {
            $manual = $soprts->manual;
            if (strlen($manual) > 0 && $manual != '[]') {
                $dt = json_decode($manual);
                $output = [];
                $index = array_search($data['sports_id'], array_column($dt, 'id'));
                if (is_numeric($index)) {
                    $title = false;
                    $b_index = 0;
                    foreach ($dt[$index]->bookmakers as $bi => $b) {
                        if ($b->title == $data['title']) {
                            $title = true;
                            $b_index = $bi;
                        }
                    }
                    if (!$title) {
                        array_push($dt[$index]->bookmakers, [
                            'title' => $data['title'],
                            'markets' => [
                                [
                                    'name' => $data['name'],
                                    'price' => $data['price'],
                                ]
                            ]
                        ]);
                    } else {
                        array_push($dt[$index]->bookmakers[$b_index]->markets, [
                            'name' => $data['name'],
                            'price' => $data['price'],
                        ]);
                    }
                } else {
                    array_push($dt, [
                        'id' => $data['sports_id'],
                        'sport_key' => $data['sports_key'],
                        'bookmakers' => [
                            [
                                'title' => $data['title'],
                                'markets' => [
                                    [
                                        'name' => $data['name'],
                                        'price' => $data['price'],
                                    ]
                                ]
                            ]
                        ]
                    ]);
                }
                $this->db->where('id', $data['id']);
                $this->db->update(db_prefix() . 'betting', ['manual' => json_encode($dt)]);
            } else {
                $output = json_encode([
                    [
                        'id' => $data['sports_id'],
                        'sport_key' => $data['sports_key'],
                        'bookmakers' => [
                            [
                                'title' => $data['title'],
                                'markets' => [
                                    [
                                        'name' => $data['name'],
                                        'price' => $data['price'],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
                $this->db->where('id', $data['id']);
                $this->db->update(db_prefix() . 'betting', ['manual' => $output]);
            }
            return ['return' => true, 'message' => _l('b_sync_done')];
        } else {
            return ['return' => false, 'message' => 'server problem'];
        }
    }

    public function confirm_online($data)
    {
        if (!is_numeric($data['amount'])) {
            return ['return' => false, 'message' => 'Must Add add your amount.'];
        }
        if (!strlen($data['details']) > 0) {
            return ['return' => false, 'message' => 'Must Add add your details.'];
        }
        if ($data['type'] == 2 && is_numeric($data['coin'])) {
            return ['return' => false, 'message' => 'Must Select Your Coin.'];
        }
        $user = $this->session->userdata('logged_in');
        $balance = floatval(get_settle_balance($user->id));
        $amount = floatval($data['amount']);

        if ($balance <  $amount) {
            return ['return' => false, 'message' => 'The amount is less than your balance. (Balance: ' . $balance . ')'];
        }

        $check = $this->db->select("count(*) as ck")->get_where('tblwithraw_history',['user_id'=>$user->id,'datetime'=>date('Y-m-d')])->row()->ck;
        if($check>2){
            return ['return' => false, 'message' => 'you can not withdraw today. try tomorrow'];
        }
        $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
        $currency_id =  $user_details->currency_id;
        $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
        $rate = $currency->price_value;
        $type = '';
        if ($data['type'] == 1) {
            $type = 'Bank';
        } else if ($data['type'] == 2) {
            $type = 'Coinbase';
        } else if ($data['type'] == 3) {
            $type = 'Perfect Money';
        } else if ($data['type'] == 4) {
            $type = 'USDT';
        }
        $this->db->insert('tblwithraw_history', [
            'user_id' => $user->id,
            'amount' => floatval($data['amount']),
            'currency_rate' => floatval($rate),
            'base_amount' => floatval($data['amount'] / $rate),
            'gateway' => 1,
            'contact_id' => 0,
            'currency_id' =>  $currency_id,
            'type' => $type,
            'coin' => $data['coin'],
            'status' => 0,
            'details' => $data['details']
        ]);
        return ['return' => true, 'message' =>  _l('b_approval')];
    }
    public function confirm_agent($data)
    {
        if (!is_numeric($data['amount'])) {
            return ['return' => false, 'message' => 'Must Add add your amount.'];
        }
        if (!strlen($data['details']) > 0) {
            return ['return' => false, 'message' => 'Must Add add your details.'];
        }
        $user = $this->session->userdata('logged_in');
        $today = date('Y-m-d');
        $w_count = 0;
        foreach($this->db->get_where('tblwithraw_history', ['user_id' => $user->id])->result() as $item){
            $date = date('Y-m-d',strtotime($item->datetime));
            if($date == $today){
                $w_count = $w_count + 1;
            }
        }
        if ($w_count >= 2) {
            return ['return' => false, 'message' => 'You have done maximam withdraw today. please try again tomorrow.'];
        }

        $balance = floatval(get_settle_balance($user->id));
        $amount = floatval($data['amount']);

        if ($balance <  $amount) {
            return ['return' => false, 'message' => 'The amount is less than your balance. (Balance: ' . $balance . ')'];
        }

        $user_details = $this->db->get_where('tbluser', ['id' => $user->id])->row();
        $currency_id =  $user_details->currency_id;
        $currency = $this->db->get_where('tblcurrencies', ['id' => $currency_id])->row();
        $rate = $currency->price_value;
        $this->db->insert('tblwithraw_history', [
            'user_id' => $user->id,
            'amount' => floatval($data['amount']),
            'currency_rate' => floatval($rate),
            'base_amount' => floatval($data['amount'] / $rate),
            'gateway' => 0,
            'contact_id' => $data['contact_id'],
            'currency_id' =>  $currency_id,
            'type' => 'Agent',
            'coin' => '',
            'status' => 0,
            'details' => $data['details']
        ]);
        return ['return' => true, 'message' =>  _l('b_approval')];
    }

    public function  delete_manual($data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['id']])->row();
        if (!empty($soprts)) {
            $this->db->where('id', $data['id']);
            $this->db->update(db_prefix() . 'betting', ['manual' => '[]']);
            return ['return' => true, 'message' => _l('b_success_delete')];
        } else {
            return ['return' => false, 'message' => 'server problem'];
        }
    }
    public function userbet($data)
    {
        $soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['id']])->row();

        $this->db->group_by('bet_name');
        $name = $this->db->get_where(db_prefix() . 'bet_history', ['sport_key' => $soprts->rel_id, 'bet_win' => 0])->result();

        return  ['bet' => $soprts, 'name' => $name, 'count' => count($this->db->get_where(db_prefix() . 'bet_history', ['sport_key' => $soprts->rel_id, 'bet_win' => 0])->result())];
    }
    public function bet_history($id)
    {
        //$soprts = $this->db->get_where(db_prefix() . 'betting', ['id' => $data['id']])->row();
        $soprts = $this->db->get_where(db_prefix() . 'bet_history', ['bet_id' => $id])->row();

        return  $soprts;
    }
    public function apply($data)
    {
        $winloss = $data['win'] == "true" ? 1 : 2;
        $name = $data['name'];
        $this->db->where('bet_name', $name);
        $this->db->update(db_prefix() . 'bet_history', ['bet_win' => $winloss]);
        return ['return' => true, 'message' => _l('b_success_save')];
    }
}
