<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    'user_id as uid',
    'action',
    'BetAmount',
    'TransactionAmount',
    'GameID',
    'CurrencyID',
    'GameRoundID',
    'create_date',

];
$sIndexColumn = 'user_id';
$sTable       = db_prefix() . 'games';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'games.user_id',
];
$where = [];
array_push($where, ' AND (user_id= ' . $this->ci->input->post('userid') . ') ');

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  get_user_name($aRow['uid']);
    $row[] =  $aRow['action'];
    $row[] =  $aRow['action'] == 'bet' ? $aRow['BetAmount'] : '';
    $row[] =  $aRow['action'] == 'settle' ? $aRow['TransactionAmount'] : '';
    $row[] =  $aRow['GameRoundID'];
    $row[] =  get_game_name($aRow['GameID']);
    $row[] =  get_currency_set($aRow['CurrencyID']);
    $row[] =  $aRow['create_date'];

    $output['aaData'][] = $row;
}
