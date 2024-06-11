<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'deposit_history.deposit_id as uid',
    db_prefix() . 'user.id as user_id',
    'transactionID',
    'remark',
    'amount',
    'gateway',
    'status',
    'tbldeposit_history.datetime as date',
    

];
$sIndexColumn = 'deposit_id';
$sTable       = db_prefix() . 'deposit_history';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'deposit_history.deposit_user_id',
];
$where = [];
array_push($where, ' AND (gateway= "USDT") ');

if ($this->ci->input->post('usd_deposit_info_get')) {
    array_push($where, ' AND (status= ' . ($this->ci->input->post('usd_deposit_info_get') - 1) . ' ) ');
}
if ($this->ci->input->post('user_usd_info_get')) {
    array_push($where, ' AND (deposit_user_id= ' . $this->ci->input->post('user_usd_info_get') . ' ) ');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  'USR-'.$aRow['uid'];
    $row[] =  deposit_design($aRow['user_id']);
    $row[] =  $aRow['transactionID'];
    $row[] =  $aRow['remark'];
    $row[] =  $aRow['amount'];
    $row[] =  $aRow['gateway'];
    $row[] =  $aRow['date'];

    $row[] =  deposit_status($aRow['status'],$aRow['uid']);
    
   

    $output['aaData'][] = $row;
}
