<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [
    db_prefix() . 'deposit_history.deposit_id as uid',
    db_prefix() . 'user.full_name as full_name',
    db_prefix() . 'user.mobile as mobile',
    db_prefix() . 'currencies.name as name',
    'transactionID',
    'base_amount',
    'currency_rate',
    'amount',
    'gateway',
    'tbldeposit_history.datetime as date',
    'status'

];
$sIndexColumn = 'deposit_id';
$sTable       = db_prefix() . 'deposit_history';
$join         = [
    'JOIN ' . db_prefix() . 'user ON ' . db_prefix() . 'user.id = ' . db_prefix() . 'deposit_history.deposit_user_id',
    'LEFT JOIN ' . db_prefix() . 'currencies ON ' . db_prefix() . 'currencies.id = ' . db_prefix() . 'deposit_history.currency',
];
$where = [];

if ($this->ci->input->post('user_info_get')) {
    array_push($where, ' AND (deposit_user_id= ' . $this->ci->input->post('user_info_get') . ' ) ');
}

if ($this->ci->input->post('payment_info')) {
    array_push($where, ' AND (status= ' . ($this->ci->input->post('payment_info') - 1) . ' ) ');
}


$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $key => $aRow) {
    $row = [];
    $row[] =  $key + 1;
    $row[] =  $aRow['full_name'];
    $row[] =  $aRow['mobile'];
    $row[] =  $aRow['transactionID'];
    $row[] =  $aRow['base_amount'];
    $row[] =  $aRow['currency_rate'];
    $row[] =  $aRow['amount'];
    $row[] =  deposit_type($aRow['gateway'],$aRow['uid'] );
    $row[] =  $aRow['name'];
    $row[] =  $aRow['date'];

    $status = '';
    if ($aRow['status'] == 2) {
        $status = '<span class="inline-block label" style="color:#f11553;border:1px solid #f11553">Reject</span>';
    } else if ($aRow['status'] == 1) {
        $status = '<span class="inline-block label" style="color: #1aa811;border: 1px solid #0b9139;">Payment</span>';
    } else {
        $status = '<span class="inline-block label" style="color: #e9cb38;border: 1px solid #e9cb38;">Pending</span>';
    }

    $row[] =   $status;
    // $row[] =  '<a href="' . admin_url('betting/admin/add_user/' . $aRow['uid']) . '" class="btn btn-info"><i class="fa fa-edit"></i></a><button  type="button" class="btn btn-info" onclick="bet.common_delete(\'' . admin_url('betting/admin/user_delete/' . $aRow['uid']) . '\')"><i class="fa fa-trash"></i></button>';
    $output['aaData'][] = $row;
}
