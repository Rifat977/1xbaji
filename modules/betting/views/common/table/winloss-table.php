<?php

defined('BASEPATH') or exit('No direct script access allowed');

$this->ci->load->model('corn_model');

$aColumns = [
    db_prefix() . 'bet_history.bet_id as uid',
    db_prefix() . 'user.id as user_id',
    'sport_id',
    'sport_key',
    'bet_name',
    'bet_price',
    'total',
    'bet_value',
    'bet_win',
    db_prefix() . 'bet_history.datetime as date',
];
$sIndexColumn = 'bet_id';
$sTable       = db_prefix() . 'bet_history';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'bet_history.user_id',
];

$where = [];

array_push($where, ' AND sport_key="' . $this->ci->input->post('sports_key') . '" ');

if ($this->ci->input->post('type'))
    array_push($where, ' AND bet_win="' . ($this->ci->input->post('type') - 1) . '" ');

if ($this->ci->input->post('bet_name'))
    array_push($where, ' AND bet_name="' . ($this->ci->input->post('bet_name')) . '" ');


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['uid'];
    $row[] =  deposit_design($aRow['user_id']);
    $data =  $this->ci->corn_model->bet_history($aRow['uid']);
    $row[] = "<p>" . $aRow['sport_id'] . "</br>" . $aRow['sport_key'] . "</br>" . $aRow['bet_name'] . "</P>";
    $row[] = $data->team;
    $row[] = $aRow['bet_price'];
    $row[] = number_format($aRow['bet_value'], 2);
    $row[] = number_format($aRow['total'], 2);

    $row[] = bet_status($data->bet_win);
    $row[] = bet_type($data->type);
    $row[] =  $aRow['date'];

    $output['aaData'][] = $row;
}
