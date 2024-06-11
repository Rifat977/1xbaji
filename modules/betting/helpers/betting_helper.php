<?php

use PhpOffice\PhpSpreadsheet\Calculation\Financial\Dollar;

use function Clue\StreamFilter\fun;

function betting_curl($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_SSL_VERIFYPEER => false
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function get_staff_role_name($staff_id)
{
    $CI = &get_instance();
    $staff = $CI->db->get_where('tblstaff', ['staffid' => $staff_id])->row();
    $role = $CI->db->get_where('tblroles', ['roleid' => $staff->role])->row();
    return  $role->name;
}
function betting_key_check($key, $type)
{
    $CI = &get_instance();
    switch ($type) {
        case BETTING_ODDS:
            $data = $CI->db->get_where(db_prefix() . 'betting', ['rel_id' => $key, 'rel_type' => BETTING_ODDS])->row();
            if (!empty($data)) {
                return 1;
            } else {
                return 0;
            }
            break;

        default:
            return 0;
            break;
    }
}

function get_agent_name($id)
{
    $CI = &get_instance();
    $agent_info = $CI->db->get_where('tblcontacts', ['id' => $id])->row();
    return $agent_info->firstname . ' ' . $agent_info->lastname;
}
function get_user_name($id)
{
    $CI = &get_instance();
    $user_info = $CI->db->get_where('tbluser', ['id' => $id])->row();
    return $user_info->full_name;
}
function get_game_name($id)
{
    $CI = &get_instance();
    $game_info = $CI->db->get_where('tblbet_game_list', ['game_code' => $id])->row();
    return $game_info->game_name;
}
function get_refference_name($id)
{
    $CI = &get_instance();
    $refer_info = $CI->db->get_where('tbluser', ['id' => $id])->row();
    if ($refer_info) {
        return $refer_info->full_name;
    } else {
        return '';
    }
}
function get_settle_balance($user_id)
{
    $CI = &get_instance();
    $settle_amount = 0;
    $get = $CI->db->order_by('id', "desc")->limit(1)->get_where("tblmeasure_withdraw", ['user_id' => $user_id])->row();
    if (!empty($get)) {
        $settle_amount = $get->settle_amount;
    }
    foreach ($CI->db->get_where('tblgames', ['user_id' => $user_id])->result() as  $game) {
        $get = $CI->db->get_where('tblmeasure_withdraw', ['game_id' => $game->id, 'user_id' => $user_id])->row();
        if (!empty($get)) {
        } else {
            $amount = 0;
            if ($game->action == 'bet') {
                $amount = $game->BetAmount;
                if (floatval($game->after_amount) >= $settle_amount) {
                    // $settle_amount = 
                } else {
                    $settle_amount =  $game->after_amount;
                }
            } else if ($game->action == 'settle') {
                $amount = $game->TransactionAmount;
                if (floatval($game->after_amount) >= $settle_amount) {
                    $settle_amount += $game->TransactionAmount;
                } else {
                    $settle_amount =  $game->after_amount;
                }
            }

            $CI->db->insert('tblmeasure_withdraw', [
                'action' => $game->action,
                'user_id' => $user_id,
                'game_id' => $game->id,
                'amount' => $amount,
                'before_balance' => $game->before_amount,
                'after_balance' => $game->after_amount,
                'settle_amount' => $settle_amount
            ]);
        }
    }

    // $CI->db->or_where('status',0);
    // $CI->db->or_where('status',1);
    // $withraw = floatval($CI->db->select('SUM(amount) AS amount')->get_where('tblwithraw_history', ['user_id' => $user_id])->row()->amount);
    $withraw0 = floatval($CI->db->select('SUM(amount) AS amount')->get_where('tblwithraw_history', ['user_id' => $user_id, 'status' => 0])->row()->amount);
    $withraw1 = floatval($CI->db->select('SUM(amount) AS amount')->get_where('tblwithraw_history', ['user_id' => $user_id, 'status' => 1])->row()->amount);

    return  $settle_amount - $withraw0 - $withraw1;
}

function get_currency_name($id)
{
    $CI = &get_instance();
    $currency_info = $CI->db->get_where('tblcurrencies', ['id' => $id])->row();
    return $currency_info->name;
}
function get_currency_set($id)
{
    $CI = &get_instance();
    $c_info = $CI->db->get_where('tblcurrencies', ['set_id' => $id])->row();
    return $c_info->name;
}
function get_currency_symble($id)
{
    $CI = &get_instance();
    $currency_info = $CI->db->get_where('tblcurrencies', ['id' => $id])->row();
    return $currency_info->symbol;
}
function sports_content($c_name, $number, $sport_title, $mode, $time, $team1, $team2, $id, $sport_key, $main_id)
{
    if ($mode == 'all') {
        $date = !empty($time) ? date('D d M Y H:i', strtotime($time)) : "";
        $mode = '';
    } else {
        $date = !empty($time) ? date('H:i', strtotime($time)) : "";
    }
    return '<div class="mb-2">
                <button type="button" style="background-color: #0007ff !important;" class="btn w-100 text-white text-start p-3 rounded-top rounded-5 view_single ' . $c_name . '_collapse" data-bs-toggle="collapse" data-bs-target="#' . $c_name . '_' . $number . '" aria-expanded="false" aria-controls="multiCollapseExample1"><span class="badge bg-warning">' . $number . ' </span> ' . $sport_title . ' <i class="fa-solid fa-chevron-down float-end"></i></button>
                <div class="collapse ' . $c_name . ' show" id="' . $c_name . '_' . $number . '">
                    <div class="card card-body text-dark">
                        <a href="' . base_url('betting/match_detail?main_id=' . $main_id . '&match_title=' . $team1 . '-' . $team2 . '&id=' . $id . '&key=' . $sport_key) . '&type=sports">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="f">F</span>
                                    <span class="b">B</span>
                                    <span class="p">P</span>
                                    <span class="t_time">' . $mode . ' ' . $date . '</span>
                                    <div class="mt-2">
                                        <h5><i class="fa-regular fa-star"></i> ' . $team1 . '-' . $team2 . ' </h5>
                                    </div>
                                </div>
                                <div>
                                    <h3><i class="fa-solid fa-chevron-right"></i></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>';
}


function sports_list($mode = "In-Play", $category_id = 0)
{
    $ci = &get_instance();

    if ($category_id != 0) {
        $ci->db->where('id', $category_id);
    }
    $cat = $ci->db->get_where(db_prefix() . 'sports_category', ['id_active' => 1])->result();

    foreach ($cat as $k => $c) {
        $result = $ci->db->get_where(db_prefix() . 'betting', ['category_id' => $c->id, 'is_active' => 1])->result();
        $number = 0;
        foreach ($result as $key => $value) {
            if (!empty($result) && $key == 0) {
                echo '<div class="d-flex justify-content-between my-3">
                <div class="category-heading " style="color:#fff;">
                    <h4>' . $c->name . '</h4>
                </div>
                <a " class="btn btn-light float-end view_all" data-bs-toggle="collapse" data-bs-target=".' . $c->name . '" aria-expanded="false">All <i class="fa-solid fa-chevron-up"></i></a>
            </div>';
            }

            if (isset($value->json)) {
                if (isset(json_decode($value->json)->odds->output)) {
                    $output = json_decode($value->json)->odds->output;
                    if (!empty($output)) {
                        foreach ($output as $k => $v) {
                            if ($mode == 'In-Play' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d')) && strtotime(date('H:i:s', strtotime($v->commence_time))) <= strtotime(date('H:i:s'))) {
                                $number += 1;
                                echo sports_content($c->name, $number, $v->sport_title, 'In-Play', '', $v->away_team, $v->home_team, $v->id, $v->sport_key, $value->id);
                            } else if ($mode == 'Today' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d'))) {
                                $number += 1;
                                echo sports_content($c->name, $number, $v->sport_title, 'Today', $v->commence_time, $v->away_team, $v->home_team, $v->id, $v->sport_key, $value->id);
                            } else if ($mode == 'Tomorrow' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d', strtotime('+1 days')))) {
                                $number += 1;
                                echo sports_content($c->name, $number, $v->sport_title, 'Tomorrow', $v->commence_time, $v->away_team, $v->home_team, $v->id, $v->sport_key, $value->id);
                            } else if ($mode == 'all') {
                                $number += 1;
                                echo sports_content($c->name, $number, $v->sport_title, 'all', $v->commence_time, $v->away_team, $v->home_team, $v->id, $v->sport_key, $value->id);
                            }
                        }
                    }
                }
            }
        }
    }
}

function sports_list_count($mode = "In-Play", $category_id = 0)
{
    $ci = &get_instance();

    if ($category_id != 0) {
        $ci->db->where('id', $category_id);
    }
    $cat = $ci->db->get_where(db_prefix() . 'sports_category', ['id_active' => 1])->result();

    $number = 0;
    foreach ($cat as $k => $c) {
        $result = $ci->db->get_where(db_prefix() . 'betting', ['category_id' => $c->id, 'is_active' => 1])->result();
        foreach ($result as $key => $value) {
            if (isset($value->json)) {
                if (isset(json_decode($value->json)->odds->output)) {
                    $output = json_decode($value->json)->odds->output;
                    if (isset($output)) {
                        if (!empty($output)) {
                            foreach ($output as $k => $v) {
                                if ($mode == 'In-Play' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d')) && strtotime(date('H:i:s', strtotime($v->commence_time))) <= strtotime(date('H:i:s'))) {
                                    $number += 1;
                                } else if ($mode == 'Today' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d'))) {
                                    $number += 1;
                                } else if ($mode == 'Tomorrow' && strtotime(date('Y-m-d', strtotime($v->commence_time))) == strtotime(date('Y-m-d', strtotime('+1 days')))) {
                                    $number += 1;
                                } else if ($mode == 'all') {
                                    $number += 1;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $number;
}

function xsign($h1, $h2)
{
    $MARCHANTKEY = get_option('betting_casino_games_marcent_key');

    $headers = $h1;

    $requestParams = $h2;
    $mergedParams = array_merge($requestParams, $headers);
    ksort($mergedParams);
    $hashString = http_build_query($mergedParams);

    $XSign = hash_hmac('sha1', $hashString, $MARCHANTKEY);
    return $XSign;
}

function dollar_exchange($user_id, $balance = 0)
{
    $ci = &get_instance();

    $user = $ci->db->get_where(db_prefix() . 'user', ['id' => $user_id])->row();
    $dollar_rate = 0;
    $dollar_amount = 0;
    if (!empty($user)) {
        if ($balance == 0) {
            $balance = own_balance($user_id);
        }
        $currency_rate = $ci->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row();
        if (!empty($currency_rate)) {
            $dollar_rate = $currency_rate->price_value;
            $dollar_amount = $balance / $currency_rate->price_value;
        }
    }

    return ['dollar_rate' => $dollar_rate, 'dollar_amount' => round($dollar_amount, 2)];
}

function own_balance($userID)
{
    $DB = &get_instance();

    $balance = 0;
    $bet_amount = 0;
    $withraw = 0;
    $profit_amount = 0;
    $loss_amount = 0;
    $a_balance = 0;



    $deposit = floatval($DB->db->select('SUM(amount) AS amount')->get_where('tbldeposit_history', ['deposit_user_id' => $userID, 'status' => 1])->row()->amount);
    $affiliate_balance = floatval($DB->db->select('SUM(affiliate_withdrow) AS amount')->get_where('tblaffiliate_history', ['user_id' => $userID])->row()->amount);

    $games_balance_bet = floatval($DB->db->select('SUM(BetAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'bet'])->row()->amount);
    $games_balance_settle = floatval($DB->db->select('SUM(TransactionAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'settle'])->row()->amount);
    $games_balance_win = floatval($DB->db->select('SUM(BetAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'win'])->row()->amount);
    $games_balance_cancle = floatval($DB->db->select('SUM(BetAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'cancle'])->row()->amount);
    $games_balance_bonus = floatval($DB->db->select('SUM(PayoutAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'bonus'])->row()->amount);
    $games_balance_jackpot = floatval($DB->db->select('SUM(PayoutAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'jackpot'])->row()->amount);
    $games_balance_buyin = floatval($DB->db->select('SUM(TransactionAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'buyin'])->row()->amount);
    $games_balance_buyout = floatval($DB->db->select('SUM(TransactionAmount) AS amount')->get_where('tblgames', ['user_id' => $userID, 'action' => 'buyout'])->row()->amount);

    // $DB->db->where('(status =0 OR status=1)');
    // $DB->db->or_where('status',1);
    $withraw0 = floatval($DB->db->select('SUM(amount) AS amount')->get_where('tblwithraw_history', ['user_id' => $userID, 'status' => 0])->row()->amount);
    $withraw1 = floatval($DB->db->select('SUM(amount) AS amount')->get_where('tblwithraw_history', ['user_id' => $userID, 'status' => 1])->row()->amount);

    // $games_balance_push = $DB->select('SUM(BetAmount) AS amount')->get_where('tblgames', ['user_id' => $userID,'action'=>'push'])->row()->amount;


    return number_format((float)((($deposit  - $withraw0 - $withraw1) + $affiliate_balance) - $games_balance_bet + $games_balance_settle + $games_balance_win + $games_balance_cancle + $games_balance_bonus + $games_balance_jackpot + $games_balance_buyin + $games_balance_buyout), 2, '.', '');
}

function genaration_affiliate_history($user_id, $genaration = 1)
{
    $ci = &get_instance();

    $result = $ci->db->get_where(db_prefix() . 'user', ['reference' => $user_id])->result();
    $gen1 = 0;
    $gen2 = 0;
    $gen3 = 0;
    foreach ($result as $key => $value) {
        $gen1  += affiliate_history($value->id);
        $gen2  += affiliate_history($value->id, 2);
        $gen3  += affiliate_history($value->id, 3);
    }
    if ($genaration == 1) {
        return  $gen1;
    } else if ($genaration == 2) {
        return  $gen2;
    } else if ($genaration == 3) {
        return  $gen3;
    }
}


function hold_balance($user_id)
{
    $ci = &get_instance();

    $hold = 0;

    $withraw_history = $ci->db->get_where(db_prefix() . 'withraw_history', ['user_id' => $user_id])->result();

    foreach ($withraw_history as $k => $v) {
        if ($v->status == 0)
            $hold += $v->amount;
    }


    return $hold;
}
function agent_current_balance($id)
{
    $ci = &get_instance();
    $ci->db->select_sum('balance');
    $agent_history = $ci->db->get_where('tblagent_history', ['agent_id' => $id])->row();
    $agent_ = $agent_history->balance;

    $ci->db->select_sum('amount');
    $agent_history = $ci->db->get_where('tblwithraw_history', ['contact_id' => $id, 'status' => 1])->row();
    $agent_withdrow = $agent_history->amount;

    $ci->db->select_sum('amount');
    $deposti_history = $ci->db->get_where('tbldeposit_history', ['contact_id' => $id, 'status' => 1])->row();
    $agent_deposit = $deposti_history->amount;

    $balance = (($agent_ + $agent_withdrow) - $agent_deposit);
    return $balance;
}

function agent_withdrow($id)
{
    $ci = &get_instance();
    return $ci->db->get_where('tblcontacts', ['id' => $id])->row()->agent_withdrow;
}
function agent_deposit($id)
{
    $ci = &get_instance();
    return $ci->db->get_where('tblcontacts', ['id' => $id])->row()->agent_deposit;
}


function deposit_design($b)
{
    $ci = &get_instance();
    $user = $ci->db->get_where(db_prefix() . 'user', ['id' => $b])->row();
    $currency = $ci->db->get_where(db_prefix() . 'currencies', ['id' => $user->currency_id])->row();
    return '<p>' . $user->full_name . '</p><p> Currency: <b>' . $currency->name . '</b></p><p>Balance: ' . number_format(own_balance($b) + hold_balance($b), 2) . '</p><p>Contact:' . $user->mobile . '</p>';
}

function deposit_status($b, $c)
{
    if ($b == 0) {
        return '<a href="#" data-toggle="tooltip" data-original-title="Accept" onclick="accept_status(' . $c . ')" class="btn btn-info"><i class="fa fa-check"></i></a>
        <a href="#" data-toggle="tooltip" data-original-title="Reject"  onclick="reject_status(' . $c . ')" class="btn btn-danger" ><i class="fa fa-times"></i></a>';
    } else if ($b == 1) {
        return '<span class="inline-block label" style="color: green;border: 1px solid green;">' . _l('accept') . '</span>';
    } else if ($b == 2) {
        return '<span class="inline-block label" style="color: red;border: 1px solid red;">' . _l('reject') . '</span>';
    } else {
        return '<span class="inline-block label" style="color: #b6b60b;border: 1px solid #b6b60b;">' . _l('b_hold') . '</span>';
    }
}

function withraw_type($type, $withraw_id)
{
    $ci = &get_instance();
    if ($type == "Agent") {
        $withdraw = $ci->db->get_where(db_prefix() . 'withraw_history', ['id' => $withraw_id])->row();
        $contact = $ci->db->get_where(db_prefix() . 'contacts', ['id' => $withdraw->contact_id])->row();
        $rowName = '<img src="' . contact_profile_image_url($contact->id) . '" class="client-profile-image-small mright5"><a href="' . admin_url('clients/client/' . $contact->userid . '?group=contacts') . '">' .  $contact->firstname . ' ' . $contact->lastname . '</a>';
        return $rowName;
    } else {
        return $type;
    }
}
function deposit_type($type, $deposit)
{
    $ci = &get_instance();
    if ($type == "Agent") {
        $deposit = $ci->db->get_where(db_prefix() . 'deposit_history', ['deposit_id' => $deposit])->row();
        $contact = $ci->db->get_where(db_prefix() . 'contacts', ['id' => $deposit->contact_id])->row();
        if (!empty($contact)) {
            $rowName = '<img src="' . contact_profile_image_url($contact->id) . '" class="client-profile-image-small mright5"><a href="' . admin_url('clients/client/' . $contact->userid . '?group=contacts') . '">' .  $contact->firstname . ' ' . $contact->lastname . '</a>';
            return $rowName;
        } else {
            return 'Agent Missing';
        }
    } else {
        return $type;
    }
}
function agent_full_name($agent_id)
{
    $ci = &get_instance();


    $contact = $ci->db->get_where(db_prefix() . 'contacts', ['id' => $agent_id])->row();
    if (!empty($contact)) {
        $rowName = '<img src="' . contact_profile_image_url($contact->id) . '" class="client-profile-image-small mright5"><a href="' . admin_url('clients/client/' . $contact->userid . '?group=contacts') . '">' .  $contact->firstname . ' ' . $contact->lastname . '</a>';
        return $rowName;
    } else {
        return 'Agent Missing';
    }
}
function withraw_coin($type, $withraw_id)
{
    $ci = &get_instance();
    if ($type == '0' || !strlen($type) > 0) {
        return "";
    } else {
        return $type;
    }
}
function agent_country($id)
{
    $ci = &get_instance();
    $agent = $ci->db->get_where(db_prefix() . 'contacts', ['id' => $id])->row();
    $client = $ci->db->get_where(db_prefix() . 'clients', ['userid' => $agent->userid])->row();
    if ($client->country != 0) {
        $country = $ci->db->get_where(db_prefix() . 'countries', ['country_id' => $client->country])->row();
        return $country->short_name;
    } else {
        return '';
    }
}
function category_n($cat_id)
{
    $ci = &get_instance();
    $cat_name = $ci->db->get_where(db_prefix() . 'casino_category', ['c_id' => $cat_id])->row();
    return $cat_name->category_name;
}

function bet_status($type)
{
    if ($type == 1) {
        return '<span class="inline-block label" style="color: green;border: 1px solid green;">' . _l('b_win') . '</span>';
    } else if ($type == 2) {
        return '<span class="inline-block label" style="color: red;border: 1px solid red;">' . _l('b_loss') . '</span>';
    } else {
        return '<span class="inline-block label" style="color: #b6b60b;border: 1px solid #b6b60b;">' . _l('b_hold') . '</span>';
    }
}

function bet_type($type)
{
    if ($type == 1) {
        return '<span class="inline-block label" style="color: red;border: 1px solid red;" >' . _l('b_manual') . '</span>';
    } else {
        return '<span class="inline-block label" style="color: green;border: 1px solid green;">' . _l('b_auto') . '</span>';
    }
}

function affiliate_history($user_id, $genaration = 0)
{

    $ci = &get_instance();
    $ci->db->select_sum('TransactionAmount');
    $win_amount = $ci->db->get_where('tblgames', ['user_id' => $user_id, 'action' => 'settle'])->row()->TransactionAmount;
    $win_persent = ($win_amount * 10) / 100;

    $ci->db->select_sum('BetAmount');
    $loss_amount = $ci->db->get_where('tblgames', ['user_id' => $user_id, 'action' => 'bet'])->row()->BetAmount;
    $loss_persent = ($loss_amount * 10) / 100;

    $withdrowable_amount = ($loss_persent - $win_persent);

    if ($genaration == 1) {
        // $amount =  $ci->db->select_sum('affiliate_withdrow')->get_where('tblaffiliate_history', ['user_id' => $main_user, 'level' => 1])->row()->affiliate_withdrow;
        return $withdrowable_amount; //-  $amount;
    }

    $total = 0;
    $genaration2_total = 0;
    $genaration3_total = 0;
    $genaration1_user = $ci->db->get_where('tbluser', ['reference' => $user_id])->result();
    foreach ($genaration1_user as $key => $value) {
        $ci->db->select_sum('TransactionAmount');
        $win_amount = $ci->db->get_where('tblgames', ['user_id' => $value->id, 'action' => 'settle'])->row()->TransactionAmount;
        $win_persent = ($win_amount * 6) / 100;

        $ci->db->select_sum('BetAmount');
        $loss_amount = $ci->db->get_where('tblgames', ['user_id' => $value->id, 'action' => 'bet'])->row()->BetAmount;
        $loss_persent = ($loss_amount * 6) / 100;

        $genaration2_total += ($loss_persent - $win_persent);

        $genaration2_user = $ci->db->get_where('tbluser', ['reference' => $value->id])->result();
        foreach ($genaration2_user as $v) {
            $ci->db->select_sum('TransactionAmount');
            $win_amount2 = $ci->db->get_where('tblgames', ['user_id' => $v->id, 'action' => 'settle'])->row()->TransactionAmount;
            $win_persent2 = ($win_amount2 * 4) / 100;

            $ci->db->select_sum('BetAmount');
            $loss_amount2 = $ci->db->get_where('tblgames', ['user_id' => $v->id, 'action' => 'bet'])->row()->BetAmount;
            $loss_persent2 = ($loss_amount2 * 4) / 100;

            $genaration3_total += ($loss_persent2 - $win_persent2);
        }
    }

    if ($genaration == 2) {
        //$amount =  $ci->db->select_sum('affiliate_withdrow')->get_where('tblaffiliate_history', ['user_id' => $user_id, 'level' => 2])->row()->affiliate_withdrow;
        return $genaration2_total; // - $amount;
    }

    if ($genaration == 3) {
        // $amount =  $ci->db->select_sum('affiliate_withdrow')->get_where('tblaffiliate_history', ['user_id' => $user_id, 'level' => 2])->row()->affiliate_withdrow;
        return $genaration3_total; //- $amount;
    }
    $ci->db->select_sum('affiliate_withdrow');
    $withdraw = $ci->db->get_where('tblaffiliate_history', ['level' => $user_id])->row()->affiliate_withdrow;

    return $withdrowable_amount + $genaration2_total +  $genaration3_total - $withdraw;
}

function user_affiliate_balance($user_id)
{
    $ci = &get_instance();
    $our_user = $ci->db->get_where('tbluser', ['reference' => $user_id])->result();
    $my_currency_id = $_SESSION['logged_in']->currency_id;
    $win_amount_ = 0;
    $loss_loss_ = 0;

    $level1 = 10;
    $level2 = 6;
    $level3 = 4;
    foreach ($our_user as $key) {
        //genaration 1
        $ci->db->select_sum('BetAmount');
        $total = $ci->db->get_where('tblgames', ['user_id' => $key->id, 'action' => 'bet'])->row()->BetAmount;
        $win_amount_ += ($total * $level1) / 100;
        $ci->db->select_sum('TransactionAmount');
        $bet_value = $ci->db->get_where('tblgames', ['user_id' => $key->id, 'action' => 'settle'])->row()->TransactionAmount;
        $loss_loss_ += ($bet_value * $level1) / 100;

        foreach ($ci->db->get_where('tbluser', ['reference' => $key->id])->result() as  $g2) {
            //genaration 2
            $ci->db->select_sum('BetAmount');
            $total = $ci->db->get_where('tblgames', ['user_id' => $g2->id, 'action' => 'bet'])->row()->BetAmount;
            $win_amount_ += ($total * $level2) / 100;
            $ci->db->select_sum('TransactionAmount');
            $bet_value = $ci->db->get_where('tblgames', ['user_id' => $g2->id, 'action' => 'settle'])->row()->TransactionAmount;
            $loss_loss_ += ($bet_value * $level2) / 100;

            foreach ($ci->db->get_where('tbluser', ['reference' => $g2->id])->result() as  $g3) {
                //genaration 3
                $ci->db->select_sum('BetAmount');
                $total = $ci->db->get_where('tblgames', ['user_id' => $g3->id, 'action' => 'bet'])->row()->BetAmount;
                $win_amount_ += ($total * $level3) / 100;
                $ci->db->select_sum('TransactionAmount');
                $bet_value = $ci->db->get_where('tblgames', ['user_id' => $g3->id, 'action' => 'settle'])->row()->TransactionAmount;
                $loss_loss_ += ($bet_value * $level3) / 100;
            }
        }
    }
    $ci->db->select_sum('affiliate_withdrow');
    $previous_amount = $ci->db->get_where('tblaffiliate_history', ['user_id' => $user_id])->row()->affiliate_withdrow;

    $my_affiliate_amount = ($win_amount_ - $loss_loss_) - $previous_amount;
    return $my_affiliate_amount;
}
function last_withdrow_affiliate($user_id)
{
    $ci = &get_instance();
    $last_withdrow = $ci->db->get_where('tblaffiliate_history', ['user_id' => $user_id])->row();
    if ($last_withdrow) {
        $date = new DateTime($last_withdrow->create_date);

        $date->modify('+15 day');
        return $date->format('Y-m-d');
    }
}


function get_IP_info()
{
    $arr = [];
    $ipaddress = $_SERVER['REMOTE_ADDR'];


    // if (isset($_SERVER['HTTP_CLIENT_IP']))
    //     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    // else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    //     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // else if (isset($_SERVER['HTTP_X_FORWARDED']))
    //     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    // else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    //     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    // else if (isset($_SERVER['HTTP_FORWARDED']))
    //     $ipaddress = $_SERVER['HTTP_FORWARDED'];
    // else if (isset($_SERVER['REMOTE_ADDR']))
    //     $ipaddress = $_SERVER['REMOTE_ADDR'];
    // else
    //     $ipaddress = '';

    if (!empty($ipaddress)) {
        $l = file_get_contents('http://ip-api.com/json/' . $ipaddress);
        $array = json_decode($l);
        if (isset($array->country)) {
            $arr = $array;
        }
    }
    return $arr;
}



function _header($req)
{
    $MARCHANT =  get_option('betting_casino_games_marcent_id');
    $MARCHANTKEY = get_option('betting_casino_games_marcent_key');
    $merchantKey = $MARCHANTKEY;
    $notic = md5(uniqid(mt_rand(), true));
    $headers = [
        'X-Merchant-Id' => $MARCHANT,
        'X-Timestamp' => time(),
        'X-Nonce' => $notic,
    ];


    $requestParams = $req;
    $mergedParams = array_merge($requestParams, $headers);
    ksort($mergedParams);
    $hashString = http_build_query($mergedParams);
    $XSign = hash_hmac('sha1', $hashString, $merchantKey);

    $header = array(
        'X-Merchant-Id: ' . $MARCHANT,
        'X-Timestamp: ' . time(),
        'Content-Type: application/x-www-form-urlencoded',
        'Accept: application/json',
        'X-Nonce: ' . $notic,
        'X-Sign: ' . $XSign
    );
    return $header;
}


function api($header, $method, $url, $play = false, $save = false)
{
    if ($play == false) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        return $result;

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => $method,
        //     CURLOPT_HTTPHEADER => $header,
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        // return $response;
    } else {
        return play_games($header, $url, $save);
    }
}

function play_games($header, $url, $save)
{
    $MARCHANT =  get_option('betting_casino_games_marcent_id');
    $MARCHANTKEY = get_option('betting_casino_games_marcent_key');
    $nonce = md5(uniqid(mt_rand(), true));
    $time = time();
    $headers = [
        'X-Merchant-Id' => $MARCHANT,
        'X-Timestamp' => $time,
        'X-Nonce' => $nonce,
    ];

    $requestParams = $header;
    // echo '<pre>';
    $mergedParams = array_merge($requestParams, $headers);
    // var_dump($mergedParams);
    ksort($mergedParams);
    $hashString = http_build_query($mergedParams);

    $XSign = hash_hmac('sha1', $hashString, $MARCHANTKEY);

    ksort($requestParams);
    $postdata = http_build_query($requestParams);

    // var_dump($mergedParams);
    // var_dump($hashString);
    // var_dump($XSign);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Merchant-Id: ' . $MARCHANT,
        'X-Timestamp: ' . $time,
        'X-Nonce: ' . $nonce,
        'X-Sign: ' . $XSign,
        'Accept: application/json',
        'Enctype: application/x-www-form-urlencoded',
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    // var_dump($result);
    // echo '</pre>';
    // die;
    //var_dump($header);die;
    if ($save) {
        $ci = &get_instance();
        $ci->db->insert(
            'tblplay',
            [
                'uuid' => $header["game_uuid"],
                'session_id' => $header["session_id"],
                'user_id' => $header["player_id"],
                'timestamp' => $time,
                'nonce' => $nonce,
                'sign' => $XSign,
                'has_string' => $hashString
            ]
        );
    }
    return $result;
}


function header_to_string($headers)
{
    $output = '';
    $i = 0;
    foreach ($headers as $key => $header) {
        $i++;
        $output .= $key . '=' . $header . (count($headers) == $i ? '' : '&');
    }
    return $output;
}

function casino_image($data)
{
    return $data->icon;
    //return module_dir_url(BETTING_MODULE_NAME, 'views/website/desktop2/assets/images/home-tabs/JILI.png');
}
function sign()
{
    $licence = get_option('betting_casino_games_marcent_key');
    $private_key = get_option('betting_casino_games_marcent_id');

    $MARCHANT =  $licence;
    $MARCHANTKEY =  $private_key;
    $nonce = md5(uniqid(mt_rand(), true));
    $time = time();
    $headers = [
        'X-Merchant-Id' => $MARCHANT,
        'X-Timestamp' => $time,
        'X-Nonce' => $nonce,
    ];
    $header = [];
    $requestParams = $header;
    $mergedParams = array_merge($requestParams, $headers);
    $hashString = http_build_query($mergedParams);
    $XSign = hash_hmac('sha1', $hashString, $MARCHANTKEY);
    return [
        'X-Merchant-Id' => $MARCHANT,
        'X-Timestamp' => $time,
        'X-Nonce' => $nonce,
        "X-Sign" => $XSign
    ];
}


function sync_bet_all_data($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(sign()),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function get_provider_name($p_id)
{
    $CI = &get_instance();
    $provider_name = $CI->db->get_where('tblbet_provider', ['provider_id' => $p_id])->row();
    return ($provider_name->provider_name);
}
function sync_bet_all_game($url, $game_type, $provider)
{
    $all = json_encode(array_merge(
        sign(),
        [
            "UserID" => 1,
            "Name" => "subasis",
            "ProductID" => $provider,
            "GameType" => $game_type,
            "LanguageCode" => "1",
            "Platform" => "1"
        ]
    ));

    // return $all;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $all,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function launch_play_game($url, $type, $provider, $game, $id, $name)
{
    $CI = &get_instance();
    $ptype = $CI->db->get_where('tblbet_game_list', ['game_code' => $game, 'provider_id' => $provider, 'game_type' => $type])->row();


    $all = [];
    //if (isset($game_provider_game_type) && $game_provider_game_type->provider_game_type != null && $game_provider_game_type->provider_game_type != NULL) {
    if ($game == false || $game == 'false' || $game == 0) {

        $all = array_merge(
            sign(),
            [
                "UserID" => $id,
                "Name" => $name,
                "ProductID" => $provider,
                "GameType" => $type,
                "LanguageCode" => "1",
                "Platform" => isMobile() == true ? 1 : 0,

            ]
        );
    } else {
        $all = array_merge(
            sign(),
            [
                "UserID" => $id,
                "Name" => $name,
                "ProductID" => $provider,
                "GameType" => $type,
                "LanguageCode" => "1",
                "Platform" => isMobile() == true ? 1 : 0,
                "GameID" => $game,
            ]
        );
    }

    if (isset($ptype) && $ptype->provider_game_type != '' && $ptype->provider_game_type != NULL && strlen($ptype->provider_game_type) > 0) {
        $all = array_merge($all, ["ProviderGameType" => $ptype->provider_game_type]);
    }
    $all = json_encode($all);

    // return $all;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $all,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
