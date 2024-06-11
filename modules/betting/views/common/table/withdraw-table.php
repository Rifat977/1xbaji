<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'withraw_history.id as uid',
    db_prefix() . 'user.id as user_id',
    'type',
    'details',
    'amount',
    'coin',
    'status',
    db_prefix() . 'withraw_history.datetime as date',
];
$sIndexColumn = 'id';
$sTable       = db_prefix() . 'withraw_history';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'withraw_history.user_id',
];

$where = [];

array_push($where, ' AND (gateway= ' . (($this->ci->input->post('online') - 1)) . ') ');

if ($this->ci->input->post('usd_deposit_info_get')) {
    array_push($where, ' AND (status= ' . ($this->ci->input->post('usd_deposit_info_get') - 1) . ' ) ');
}

if ($this->ci->input->post('user_id')) {
    array_push($where, ' AND (user_id= ' . $this->ci->input->post('user_id') . ' ) ');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $aRow['uid'];
    $row[] =  deposit_design($aRow['user_id']);
    $row[] =  withraw_type($aRow['type'], $aRow['uid']);
    $row[] =  withraw_coin($aRow['coin'], $aRow['uid']);
    $row[] =  $aRow['details'];
    $row[] =  number_format($aRow['amount'], 2);

    $row[] =  $aRow['date'];

    $row[] = deposit_status((($this->ci->input->post('online') == 2) ? $aRow['status'] : ($aRow['status'] == 0 ? 4 : $aRow['status'])), $aRow['uid']);

    $output['aaData'][] = $row;
}
